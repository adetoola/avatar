<?php

namespace Adetoola\Avatar;

use Adetoola\Avatar\Exception\AvatarException;

use Intervention\Image\Image;
use Intervention\Image\ImageManager;

class Avatar
{
    /**
     * @var ImageManager
     */
    private $image;

    /**
     * @var Initials
     */
    private $initials;

    // Set default parameters
    private $size = 480;
    private $bgColor = [
        "#ff4040", "#7f2020", "#cc5c33", "#734939", "#bf9c8f", "#995200",
        "#4c2900", "#f2a200", "#ffd580", "#332b1a", "#4c3d00", "#ffee00",
        "#b0b386", "#64664d", "#6c8020", "#c3d96c", "#143300", "#19bf00",
        "#53a669", "#bfffd9", "#40ffbf", "#1a332e", "#00b3a7", "#165955",
        "#00b8e6", "#69818c", "#005ce6", "#6086bf", "#000e66", "#202440",
        "#393973", "#4700b3", "#2b0d33", "#aa86b3", "#ee00ff", "#bf60b9",
        "#4d3949", "#ff00aa", "#7f0044", "#f20061", "#330007", "#d96c7b"
    ];
    private $rounded = false;
    private $text = 'AVA';
    private $color = '#fff';
    private $fontFile = '/fonts/Roboto-Regular.ttf';
    private $fontSize = 0.5;
    private $angle = 0;

    public function __construct()
    {
        $this->image = new ImageManager();
        $this->initials = new Initials();
    }

    public function size(int $size): self
    {
        if( $size < 1 ) {
            throw new AvatarException('Size can not be less than 1');
        }
        $this->size = (int) $size;
        return $this;
    }

    public function background($background = null)
    {
        if( is_array($background) ) {
            $this->bgColor = $background;
        }elseif( is_string($background) ) {
            $this->bgColor = (string) $background;
        }
        return $this;
    }

    public function rounded($rounded = false): self
    {
        $this->rounded = (bool) $rounded;
        return $this;
    }

    public function name($name = null): self
    {
        $this->initials->name($name);
        $this->text =  $this->initials->getInitials();
        return $this;
    }

    public function length($length = 3): self
    {
        $this->initials->length($length);
        return $this;
    }

    public function color(string $color): self
    {
        $this->color = (string) $color;
        return $this;
    }

    public function font(string $font): self
    {
        $this->fontFile = (string) $font;
        return $this;
    }

    public function fontSize(float $fontSize = 0.5): self
    {
        $this->fontSize = number_format($fontSize, 2);
        return $this;
    }

    public function angle(float $angle = 90): self
    {
        $this->angle = $angle;
        return $this;
    }

    public function getSize(): float
    {
        return $this->size;
    }

    public function getRounded(): bool
    {
        return $this->rounded;
    }

    public function getBackground(): string
    {
        if(is_string($this->bgColor) ) {
            return $this->bgColor;
        }

        // user either didn't specify a background or background was array
        shuffle($this->bgColor);
        $this->bgColor = array_shift($this->bgColor);
        return $this->bgColor;
    }
    public function getColor(): string
    {
        return $this->color;
    }

    public function getFont(): string
    {
        return $this->fontFile;
    }

    public function getFontSize(): string
    {
        return $this->fontSize;
    }

    public function getInitials(): string
    {
        return $this->text;
    }

    public function getAngle(): float
    {
        return $this->angle;
    }

    public function generate(): Image
    {
        $img = $this->make($this->image);
        return $img;
    }

    public function __toString()
    {
        return (string) $this->generate()->encode('data-url');
    }

    /**
     * Make Avatar
     * @param  ImageManager|ImageCache $image
     * @return Image|ImageCache
     */
    private function make($image)
    {
        $size = $this->getSize();
        $rounded = $this->getRounded();
        $bgColor = $this->getBackground();
        $color = $this->getColor();
        $fontFile = $this->getFont();
        $fontSize = $this->getFontSize();
        $text = $this->getInitials();
        $angle = $this->getAngle();

        $avatar = $image->canvas($size, $size, ! $rounded ? $bgColor : null);

        if( $rounded ) {
            // $avatar =
            $avatar->circle($size, $size / 2, $size / 2, function ($draw) use ($bgColor) {
                return $draw->background($bgColor);
            });
        }

        return $avatar->text($text, $size / 2, $size / 2, function ($font) use ($size, $color, $fontFile, $fontSize, $angle) {
            $font->file(__DIR__ . $fontFile);
            $font->size($size * $fontSize);
            $font->color($color);
            $font->align('center');
            $font->valign('center');
            $font->angle($angle);
        });
    }
}
