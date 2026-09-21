<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use RuntimeException;

class ImageProcessor
{
    /**
     * Redimensiona e recorta a imagem pelo centro, sem distorcer, até preencher
     * exatamente as dimensões solicitadas.
     */
    public function cover(UploadedFile $arquivo, string $destino, int $largura, int $altura): void
    {
        if (! extension_loaded('gd')) {
            throw new RuntimeException('A extensão GD do PHP não está instalada.');
        }

        $conteudo = file_get_contents($arquivo->getRealPath());
        $origem = $conteudo !== false ? imagecreatefromstring($conteudo) : false;

        if ($origem === false) {
            throw new RuntimeException('Não foi possível abrir a imagem enviada.');
        }

        $larguraOriginal = imagesx($origem);
        $alturaOriginal = imagesy($origem);
        $proporcaoDestino = $largura / $altura;
        $proporcaoOriginal = $larguraOriginal / $alturaOriginal;

        if ($proporcaoOriginal > $proporcaoDestino) {
            $recorteAltura = $alturaOriginal;
            $recorteLargura = (int) round($alturaOriginal * $proporcaoDestino);
            $origemX = (int) round(($larguraOriginal - $recorteLargura) / 2);
            $origemY = 0;
        } else {
            $recorteLargura = $larguraOriginal;
            $recorteAltura = (int) round($larguraOriginal / $proporcaoDestino);
            $origemX = 0;
            $origemY = (int) round(($alturaOriginal - $recorteAltura) / 2);
        }

        $resultado = imagecreatetruecolor($largura, $altura);
        imagealphablending($resultado, false);
        imagesavealpha($resultado, true);
        $transparente = imagecolorallocatealpha($resultado, 0, 0, 0, 127);
        imagefill($resultado, 0, 0, $transparente);

        imagecopyresampled(
            $resultado,
            $origem,
            0,
            0,
            $origemX,
            $origemY,
            $largura,
            $altura,
            $recorteLargura,
            $recorteAltura
        );

        $temporario = $destino . '.tmp';
        $extensao = strtolower(pathinfo($destino, PATHINFO_EXTENSION));
        $gravou = match ($extensao) {
            'jpg', 'jpeg' => imagejpeg($resultado, $temporario, 88),
            'png' => imagepng($resultado, $temporario, 7),
            'webp' => imagewebp($resultado, $temporario, 88),
            default => false,
        };

        imagedestroy($origem);
        imagedestroy($resultado);

        if (! $gravou || ! rename($temporario, $destino)) {
            @unlink($temporario);
            throw new RuntimeException('Não foi possível salvar a imagem tratada.');
        }
    }
}
