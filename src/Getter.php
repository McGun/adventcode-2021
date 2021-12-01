<?php

namespace Code;

use Exception;

class Getter
{
    public function readFileInput(string $filePath):string
    {
        if (!file_exists($filePath)) {
            throw new Exception(sprintf("No file found at:\n%s\n", $filePath));
        }

        return file_get_contents($filePath);
    }

    public function getInputAsArray($filePath): array
    {
        return explode(
            "\n",
            $this->readFileInput($filePath)
        );
    }
}
