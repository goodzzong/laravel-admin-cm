<?php

namespace App\Admin\Extensions\Nav;

class Links
{
    public function __toString()
    {
        return <<<HTML

<li>
    <a href="http://mail.sysmate.co.kr/" target="_blank" >
      화사메일
    </a>
</li>

<li>
    <a href="https://www.bizplay.co.kr/" target="_blank" >
      bizplay
    </a>
</li>

<li>
    <a href="http://sysmate.co.kr/" target="_blank" >
      Sysmate
    </a>
</li>

<li>
    <a href="http://neokiosk.co.kr/" target="_blank">
      Neokiosk
    </a>
</li>

<li>
    <a href="http://nas.sysmate.co.kr/" target="_blank" >
      시스메이트(Nas)
    </a>
</li>
  

HTML;
    }
}