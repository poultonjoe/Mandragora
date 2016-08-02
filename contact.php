<?php
/**
 * Template Name: Contact
 * @package Mandragora
 * @since Mandragora 1.0
 */

if (isset($_POST['submit'])) {
    if(trim($_POST['checking']) !== '') {
        $captchaError = true;
    } else {
        $emailTo = 'lee.ellam@gmail.com';
        $subject = "Website enquiry: " . strip_tags($_POST['subject']);
        $firstName = strip_tags($_POST['first-name']);
        $lastName = strip_tags($_POST['last-name']);
        $emailAddress = strip_tags($_POST['email']);
        $workType = strip_tags($_POST['work-type']);
        $deliveryDate = strip_tags($_POST['delivery-date']);
        $collectionMethod = strip_tags($_POST['collection-method']);
        $address = strip_tags($_POST['address']);
        $city = strip_tags($_POST['city']);
        $country = strip_tags($_POST['country']);
        $zipCode = strip_tags($_POST['zip-code']);
        $message = strip_tags($_POST['message']);

        $body = '
        <html>
            <body>
                <p><strong>Name:</strong> '.$firstName.' '.$lastName.'</p>
                <p><strong>Email address:</strong> '.$emailAddress.'</p>
                <p><strong>Work Type:</strong> '.$workType.'</p>
                <p><strong>Delivery Date:</strong> '.$deliveryDate.'</p>
                <p><strong>Collection Method:</strong> '.$collectionMethod.'</p>';
        if ($collectionMethod == 'post') {
            $body .= '<p><strong>Address:</strong> '.$address.', '.$city.', '.$country.', '.$zipCode.'</p>';
        }
        $body .= '
                <p><strong>Message:</strong></p>
                <p>'.$message.'</p>
            </body>
        </html>';
        $headers = array('From: Mandragora Translations <admin@mandragoratranslations.com>', 'Reply-To: Haizea Moreno <admin@mandragoratranslations.com>');
        add_filter( 'wp_mail_content_type', function( $content_type ) {
            return 'text/html';
        });
        $uploads = wp_upload_dir();
        $uploadPath = $uploads['basedir'];
        $moveFile = move_uploaded_file($_FILES["attachment"]["tmp_name"], $uploadPath.'/'.$_FILES['attachment']['name']);
        if ($moveFile) {
            $attachments = array($uploadPath.'/'.$_FILES['attachment']['name']);
            wp_mail($emailTo, $subject, $body, $headers, $attachments);
            unlink($uploadPath.'/'.$_FILES['attachment']['name']);
            
            // Redirect
            $slug = pll_current_language() == 'en' ? 'thank-you' : 'gracias';
            $page = get_page_by_path($slug);
            wp_redirect(get_permalink($page->ID));
            exit();
        } else {
            $hasError = true;
        }
    }
}
get_header();
?>
<main role="main" class="site-content">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <section class="hero hero-contact">
        <h1 class="hero-title"><?php get_field('header') ? the_field('header') : the_title(); ?></h1>
        <div class="hero-content user-defined-markup clearfix">
            <?php the_content(); ?>
        </div>
        <?php if(isset($hasError) || isset($captchaError)) { ?>
            <p class="error"><?php _e('There was an error submitting the form.', 'mandragora'); ?><p>
        <?php } ?>
        <form class="form contact-form" method="post" action="<?php the_permalink(); ?>" enctype="multipart/form-data">
            <div class="form-field-group">
                <div class="form-field">
                    <label for="first-name" class="form-label form-label-hidden"><?php _e('first name', 'mandragora'); ?></label>
                    <input required id="first-name" name="first-name" class="form-input form-input-text" placeholder="<?php _e('first name', 'mandragora'); ?>*">
                </div>
                <div class="form-field">
                    <label for="last-name" class="form-label form-label-hidden"><?php _e('last name', 'mandragora'); ?></label>
                    <input required id="last-name" name="last-name" class="form-input form-input-text" placeholder="<?php _e('last name', 'mandragora'); ?>*">
                </div>
            </div>
            <div class="form-field">
                <label for="email" class="form-label form-label-hidden"><?php _e('e-mail address', 'mandragora'); ?></label>
                <input required id="email" name="email" class="form-input form-input-email" type="email" placeholder="<?php _e('e-mail address', 'mandragora'); ?>*">
            </div>
            <div class="form-field">
                <label for="subject" class="form-label form-label-hidden"><?php _e('subject', 'mandragora'); ?></label>
                <input required id="subject" name="subject" class="form-input form-input-text" placeholder="<?php _e('subject', 'mandragora'); ?>*">
            </div>
            <div class="form-field-group">
                <div class="form-field form-field-select">
                    <label for="work-type" class="form-label form-label-hidden"><?php _e('work type', 'mandragora'); ?></label>
                    <select required id="work-type" name="work-type" class="form-select">
                        <option><?php _e('type of work', 'mandragora'); ?></option>
                        <option value="Simple Translation"><?php _e('Simple Translation', 'mandragora'); ?></option>
                        <option value="Sworn Translation"><?php _e('Sworn Translation', 'mandragora'); ?></option>
                        <option value="Interpreting Services"><?php _e('Interpreting Services', 'mandragora'); ?></option>
                        <option value="Proofreading and Editing"><?php _e('Proofreading and Editing', 'mandragora'); ?></option>
                        <option value="Transcription and Editing"><?php _e('Transcription and Editing', 'mandragora'); ?></option>
                        <option value="Other"><?php _e('Other Enquiries', 'mandragora'); ?></option>
                    </select>
                </div>
                <div class="form-field">
                    <label for="delivery-date" class="form-label form-label-hidden"><?php _e('delivery date', 'mandragora'); ?></label>
                    <input required id="delivery-date" name="delivery-date" class="form-input form-input-date" type="date">
                </div>
                <div class="form-field form-field-select">
                    <label for="collection-method" class="form-label form-label-hidden"><?php _e('collection method', 'mandragora'); ?></label>
                    <select required id="collection-method" name="collection-method" class="form-select collection-method">
                        <option><?php _e('collection method', 'mandragora'); ?></option>
                        <option value="email"><?php _e('Email', 'mandragora'); ?></option>
                        <option value="in person"><?php _e('In person', 'mandragora'); ?></option>
                        <option value="post"><?php _e('By post', 'mandragora'); ?></option>
                    </select>
                </div>
            </div>
            <div class="form-field-group address-fields" style="display:none">
                <div class="form-field-group">
                    <div class="form-field">
                        <label for="address" class="form-label form-label-hidden"><?php _e('address', 'mandragora'); ?></label>
                        <input required id="address" name="address" class="form-input form-input-text" placeholder="<?php _e('address', 'mandragora'); ?>*">
                    </div>
                </div>
                <div class="form-field-group">
                    <div class="form-field">
                        <label for="city" class="form-label form-label-hidden"><?php _e('city', 'mandragora'); ?></label>
                        <input required id="city" name="city" class="form-input form-input-text" placeholder="<?php _e('city', 'mandragora'); ?>*">
                    </div>
                    <div class="form-field form-field-select">
                        <label for="country" class="form-label form-label-hidden"><?php _e('country', 'mandragora'); ?></label>
                        <select required id="country" name="country" class="form-select country">
                            <option><?php _e('country', 'mandragora'); ?></option>
                            <option value="United States"><?php _e('United States', 'mandragora'); ?></option>
                            <option value="United Kingdom"><?php _e('United Kingdon', 'mandragora'); ?></option>
                            <option value="Spain"><?php _e('Spain', 'mandragora'); ?></option>
                        </select>
                    </div>
                    <div class="form-field">
                        <label for="zip-code" class="form-label form-label-hidden"><?php _e('zip code', 'mandragora'); ?></label>
                        <input required id="zip-code" name="zip-code" class="form-input form-input-text" placeholder="<?php _e('zip code', 'mandragora'); ?>*">
                    </div>
                </div>
            </div>
            <div class="form-field form-field-file" data-file="<?php _e('upload document', 'mandragora'); ?>">
                <label for="file" class="form-label form-label-hidden"><?php _e('upload document', 'mandragora'); ?></label>
                <input required id="file" name="attachment" class="form-input form-input-file" type="file" placeholder="<?php _e('browse', 'mandragora'); ?>*">
            </div>
            <div class="form-field">
                <label for="message" class="form-label"><?php _e('message', 'mandragora'); ?>*</label>
                <textarea required id="message" name="message" class="form-textarea"></textarea>
            </div>
            <label class="form-label form-label-hidden" for="checking"><?php _e('If you want to submit this form, do not enter anything in this field', 'mandragora'); ?> <input type="text" name="checking" id="checking" value="<?php if(isset($_POST['checking'])) echo $_POST['checking'];?>" /></label>
            <div class="form-footnote">*<?php _e('required', 'mandragora'); ?></div>
            <button name="submit" type="submit" class="button button-primary button-large button-send"><?php _e('Send enquiry', 'mandragora'); ?></button>
        </form>
    </section>
<?php endwhile; endif; ?>
</main>
<?php get_footer(); ?>