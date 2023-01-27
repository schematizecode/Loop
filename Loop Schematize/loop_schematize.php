<?php
/*
Plugin Name: Loop Post Type
Author: Seu nome
Version: 1.0.0
*/

function create_loop_post_type() {
    register_post_type( 'loop',
        array(
            'labels' => array(
                'name' => __( 'Loops' ),
                'singular_name' => __( 'Loop' )
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array( 'title' )
        )
    );
    require plugin_dir_path( __FILE__ ).'fields.php';
}

add_action( 'init', 'create_loop_post_type' );

function add_custom_css() {
    echo '<style>
    .titulo_lp {
        font-size: 40px;
        text-align: center;
    }
    .bt {
        background: #0066ff;
        border-radius: 40px;
        width: 90%;
        border: none;
        color: white;
        font-weight: 600;
        padding: 20px;
        font-size: 20px;
        text-align: center;
    }
    .sub {
        font-size: 20px;
    }
    .divcont {
        text-align: center;
        width: 50%;
        margin-left: auto;
        margin-right: auto;
    }
    
    @media screen and (max-width: 750px) {
        .titulo_lp {
        font-size: 28px;
        text-align: center;
    }
        .bt {
            width: 100%;
            font-size: 12px;
            padding: 15px;
        }
        .divcont {
            width: 100%;
            padding: 10px;
            padding-bottom: 40px;
        }
        .sub {
            font-size: 20px;
        }
        .intro {
            font-size: 20px;
        }
    }
    </style>';
}
add_action( 'wp_head', 'add_custom_css' );

function shortcode_simples($atts) {
	$titulo1 = get_field('titulo_da_landing_page');
	echo '<h1 class="titulo_lp">' . $titulo1 . '</h1>';
	$post_id = $atts['id'];
    $output = '';
    if( have_rows('campos_do_repetidor',$post_id) ):
        while ( have_rows('campos_do_repetidor',$post_id) ) : the_row();
			$output .= '<div class="divcont">';
            $url_do_botao = get_sub_field('url_do_botao');
			$texto_do_botao = get_sub_field('texto_do_botao');
			$conteudo = get_sub_field('conteudo');
			$titulo = get_sub_field('titulo');
	 		$intro = get_sub_field('intro');
	
			
			$output .= '<a href="' . $url_do_botao . '"><button class="bt">' . $texto_do_botao . '</button></a><br><br>';
			$output .= '<h2 class="sub">' . $titulo . '</h2>';
           	$output .= '<p class="intro">' . $intro . '</p>';
			$output .= '<a href="' . $url_do_botao . '"><button class="bt">' . $texto_do_botao . '</button></a>';
            $output .= '<div>' . $conteudo . '</div>';
			$output .= '<a href="' . $url_do_botao . '"><button class="bt">' . $texto_do_botao . '</button></a><br><br>';
			$output .= '<hr><br><br></div>';
        endwhile;
    else :
        $output = 'Nenhum item encontrado';
    endif;
    return $output;
}
add_shortcode('shortcode_simples', 'shortcode_simples');

?>