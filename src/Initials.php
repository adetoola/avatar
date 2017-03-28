<?php

namespace Adetoola\Avatar;

class Initials
{
    private $length = 3;
    private $initials = 'ADE';

    public function name(string $name): self
    {
        $this->name = $name;
        $this->initials = $this->make();

        return $this;
    }

    public function length(int $length = 3): self
    {
        $this->length = (int) $length;
        $this->initials = $this->make();

        return $this;
    }

    public function getInitials(): string
    {
        return $this->initials;
    }

    public function __toString(): string
    {
        return $this->getInitials();
    }

    public function generate($name = null): string
    {
        if( $name !== null ) {
            $this->name = $name;
            $this->initials = 'JD';
        }

        return (string) $this;
    }

    private function make(): string
    {
        if (filter_var($this->name, FILTER_VALIDATE_EMAIL)){
            $name = explode('@', $this->name);
            $name = $name[0]; // pick only local part
            $name = preg_split("/[.-_]+/", $name);
        }else{
            // split the phrase by any number of commas or space characters like " ", \r, \t, \n and \f
            $name = preg_split("/[\s,]+/", $this->name);
        }

        $initials = '';
        if( count($name) > 1 ) {
            foreach ($name as $word) {
                $initials .= mb_substr($word, 0, 1);
            }
        }else{
            $initials = $name[0];
        }
        $initials = mb_substr($initials, 0, $this->length);

        return strtoupper($initials);
    }
}
