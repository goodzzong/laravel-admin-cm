<?php

namespace App\Admin\Extensions\Nav;

class Links
{
    public function __toString()
    {
        return <<<HTML

<li>
    <a href="http://mail.sysmate.co.kr/" target="_blank" style="font-size: 1.6rem;font-weight: bold" >
      <i class="fa fa-link"></i> 회사메일
    </a>
</li>

<li>
    <a href="https://www.bizplay.co.kr/" target="_blank" style="font-size: 1.6rem;font-weight: bold" >
      <i class="fa fa-link"></i> bizplay
    </a>
</li>

<li>
    <a href="http://sysmate.co.kr/" target="_blank" style="font-size: 1.6rem;font-weight: bold" >
      <i class="fa fa-link"></i> Sysmate
    </a>
</li>

<li>
    <a href="http://neokiosk.co.kr/" target="_blank" style="font-size: 1.6rem;font-weight: bold" >
      <i class="fa fa-link"></i> Neokiosk
    </a>
</li>

<li>
    <a href="http://nas.sysmate.co.kr/" target="_blank" style="font-size: 1.6rem;font-weight: bold" >
      <i class="fa fa-link"></i> 시스메이트(Nas)
    </a>
</li>
  

HTML;
    }
}