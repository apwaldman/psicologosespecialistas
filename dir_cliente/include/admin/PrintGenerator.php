<?php
class PrintGenerator {
    public static function prepareContent($content, $pacienteId) {
        // Remove botões e elementos não necessários para impressão
        $dom = new DOMDocument();
        @$dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'));
        
        // Remove elementos com classe no-print
        $xpath = new DOMXPath($dom);
        $noPrintElements = $xpath->query("//*[contains(@class, 'no-print')]");
        foreach ($noPrintElements as $element) {
            $element->parentNode->removeChild($element);
        }
        
        // Adiciona cabeçalho de impressão
        $header = $dom->createElement('div');
        $header->setAttribute('class', 'print-header');
        $header->setAttribute('style', 'text-align: center; margin-bottom: 20px;');
        
        $title = $dom->createElement('h3', 'Resultado do Teste YSQL');
        $subtitle = $dom->createElement('p', 'Paciente ID: ' . $pacienteId);
        $subtitle->setAttribute('style', 'font-size: 12px; margin-top: 5px;');
        
        $header->appendChild($title);
        $header->appendChild($subtitle);
        
        $body = $dom->getElementsByTagName('body')->item(0);
        $body->insertBefore($header, $body->firstChild);
        
        // Adiciona rodapé de impressão
        $footer = $dom->createElement('div');
        $footer->setAttribute('class', 'print-footer');
        $footer->setAttribute('style', 'text-align: center; margin-top: 20px; font-size: 10px;');
        
        $date = $dom->createElement('p', 'Impresso em: ' . date('d/m/Y H:i'));
        $footer->appendChild($date);
        
        $body->appendChild($footer);
        
        return $dom->saveHTML();
    }
}