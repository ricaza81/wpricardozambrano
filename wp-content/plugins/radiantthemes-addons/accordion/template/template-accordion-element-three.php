<?php
/**
 * Accordion Template Style Three
 *
 * @package Radiantthemes
 */

$output .= '<div class="rt-accordion-item">';
$output .= '<div class="rt-accordion-item-title">';
$output .= '<div class="rt-accordion-item-title-icon">';
$output .= '<div class="holder">';
$output .= '<i class="fa fa-plus"></i>';
$output .= '<i class="fa fa-minus"></i>';
$output .= '</div>';
$output .= '</div>';
$output .= '<h4 class="panel-title">' . esc_attr( $shortcode['radiant_accordiontitle'] ) . '</h4>';
$output .= '</div>';
$output .= '<div class="rt-accordion-item-body">';
$output .= $content;
$output .= '</div>';
$output .= '</div>';
