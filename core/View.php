<?php

namespace Core;

class View
{
    public static function render(string $view, array $parameters = []): string
    {
        $filePath = 'app/Views/' . strtolower($view) . '.html';
        $file = file_get_contents($filePath);
        $offset = '0';
        do {
            $start = strpos($file, '{{ ', $offset);
            $end = strpos($file, ' }}', $offset);
            if (is_numeric($start) && is_numeric($end)) {
                $anyParam = true;
                $start += 3;
                $length = $end - $start;
                $varName = substr($file, $start, $length);
                $varValue = array_key_exists($varName, $parameters) ? $parameters[$varName] : '';
                $view = str_replace('{{ ' . $varName . ' }}', $varValue, $file);
            } else {
                $anyParam = false;
            }
            $offset = $end + 3;
        } while ($anyParam == true);
        return $view;
    }
}
