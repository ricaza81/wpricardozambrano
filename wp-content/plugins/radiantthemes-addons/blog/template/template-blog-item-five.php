<?php
/**
 * Template Blog Item Five.
 *
 * @package Radiantthemes
 */
$output .= '<article class="blog-item ' . $rt_animation . '" ' . $time . '>';
$output .= '<div class="holder">';
$output .= '<div class="pic">';
$output .= '<img src="' . plugins_url( 'radiantthemes-addons/blog/images/blank-image-100x60.jpg' ) . '" alt="blank image" width="100" height="60">';
$output .= '<a class="holder" href="' . get_the_permalink() . '" style="background-image:url(' . get_the_post_thumbnail_url( get_the_ID(), 'large' ) . ')"></a>';
$output .= '</div>';
$output .= '<div class="date">' . get_the_date( 'M' ) . ' <strong>' . get_the_date( 'd' ) . '</strong></div>';
$output .= '<div class="data">';
$output .= '<h4>';
$output .= '<a href="' . get_the_permalink() . '">' . get_the_title() . '</a>';
$output .= '</h4>';
$output .= '<ul class="meta">';
$output .= '<li><i class="fa fa-user-o"></i> ' . get_the_author() . '</li>';
$output .= '</ul>';
$output .= '<p>' . wp_trim_words( get_the_excerpt(), 20, '...' ) . '</p>';
$output .= '<a class="btn" href="' . get_the_permalink() . '">' . esc_html__( 'Read More', 'radiantthemes-addons' ) . '</a>';
$output .= '</div>';
$output .= '</div>';
$output .= '</article>';
