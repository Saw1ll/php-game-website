<?php

function generateCardItem($src, $text, $label, $path): string
{
    return '
        <li class="cards__item">
            <a href="' . $path . '" class="cards__item__link">
                <figure class="cards__item__pic-wrap" data-category="' . $label . '">
                    <img src="' . $src . '" alt="Functional games" class="cards__item__img" />
                </figure>
                <div class="cards__item__info">
                    <h5 class="cards__item__text">' . $text . '</h5>
                </div>
            </a>
        </li>
    ';
}

?>