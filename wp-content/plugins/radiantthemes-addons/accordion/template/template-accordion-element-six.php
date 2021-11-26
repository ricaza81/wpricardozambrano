<?php
/**
 * Accordion Template Style Six
 *
 * @package Radiantthemes
 */

$output .= '<div class="rt-accordion-item">';
$output .= '<div class="rt-accordion-item-title">';
$output .= '<h4 class="panel-title">' . esc_attr( $shortcode['radiant_accordiontitle'] ) . '</h4>';
$output .= '<div class="rt-accordion-item-title-icon">';
$output .= '<div class="symbol"></div>';
$output .= '</div>';
$output .= '</div>';
$output .= '<div class="rt-accordion-item-body">';
$output .= $content;
$output .= '</div>';
$output .= '</div>';
