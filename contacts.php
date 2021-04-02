<?php
/*
Template Name: Страница Контакты
Template Post Type: page
*/

get_header();
?>
<section class="section-dark">
  <div class="container">
    <?php the_title('<h1 class="page-title">', '</h1>', true); ?>
    <div class="contacts-wrapper">
      <div class="left">
        <h2 class="cotacts-title">Через форму обратной связи</h2>

        <form id="contacts_form" class="contacts-form">
          <input name="contact_name" id="" type="text" class="input contacts-input" placeholder="Ваше имя">
          <input name="contact_email" id="" type="email" class="input contacts-input" placeholder="Ваш email">
          <textarea name="contact_comment" id="" class="textarea contacts-textarea" placeholder="Ваш вопрос">
          </textarea>
          <button id="contacts_form_button" class="button more" type="submit">Отправить</button>
          <input hidden id="vp_send_cont_form" name="action" value="vp_send_cont_form" type="text">
          <?php wp_nonce_field('send_cont_form','_nonce_send_cont_form'); ?>
        </form>

        <?php echo do_shortcode( '[contact-form-7 id="288" title="Контактная форма"]' )?>
      </div>
      <div class="right">
        <h2 class="cotacts-title">Или по этим контактам</h2>
        <?php if( get_field('email') ): ?>
        <a href="mail-to:'<?php the_field( 'email' ); ?>"><?php the_field( 'email' ); ?></a>
        <?php endif; ?>
        <?php if( get_field('address') ): ?>
        <address><?php the_field( 'address' ); ?></address>
        <?php endif; ?>
        <?php if( get_field('phone') ): ?>
        <a href="tel:<?php the_field( 'phone' ); ?>"><?php the_field( 'phone' ); ?></a>
        <?php endif; ?>
      </div>
    </div>
    
  </div>
</section>

<?php 
get_footer();