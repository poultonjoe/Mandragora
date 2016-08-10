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
        $emailTo = get_bloginfo('adminpll_email');
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
        $region = strip_tags($_POST['region']);
        $message = strip_tags($_POST['message']);

        $body = '
        <html>
            <body>
                <div><strong>Name:</strong> '.$firstName.' '.$lastName.'<br />
                <strong>Email address:</strong> '.$emailAddress.'<br />
                <strong>Work Type:</strong> '.$workType.'<br />
                <strong>Delivery Date:</strong> '.$deliveryDate.'<br />
                <strong>Collection Method:</strong> '.$collectionMethod.'<br />';
        if ($collectionMethod == 'post') {
            $body .= '<strong>Address:</strong> '.$address.', '.$city.', '.$country.', '.$zipCode.'<br />';
            $body .= '<strong>Region:</strong> '.$region.'<br />';
        }
        $body .= '
                <strong>Message:</strong><br />
                '.$message.'</div>
            </body>
        </html>';
        $headers = array('From: Mandragora Translations <hello@mandragoratranslations.com>', 'Reply-To: Mandragora Translations <hello@mandragoratranslations.com>');
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
            <p class="error"><?php pll_e('There was an error submitting the form.', 'mandragora'); ?><p>
        <?php } ?>
        <form class="form contact-form" method="post" action="<?php the_permalink(); ?>" enctype="multipart/form-data">
            <div class="form-field-group name-fields">
                <div class="form-field">
                    <label for="first-name" class="form-label form-label-hidden"><?php pll_e('first name', 'mandragora'); ?></label>
                    <input required id="first-name" name="first-name" class="form-input form-input-text" placeholder="<?php pll_e('first name', 'mandragora'); ?>*">
                </div>
                <div class="form-field">
                    <label for="last-name" class="form-label form-label-hidden"><?php pll_e('last name', 'mandragora'); ?></label>
                    <input required id="last-name" name="last-name" class="form-input form-input-text" placeholder="<?php pll_e('last name', 'mandragora'); ?>*">
                </div>
            </div>
            <div class="form-field">
                <label for="email" class="form-label form-label-hidden"><?php pll_e('e-mail address', 'mandragora'); ?></label>
                <input required id="email" name="email" class="form-input form-input-email" type="email" placeholder="<?php pll_e('e-mail address', 'mandragora'); ?>*">
            </div>
            <div class="form-field">
                <label for="subject" class="form-label form-label-hidden"><?php pll_e('subject', 'mandragora'); ?></label>
                <input required id="subject" name="subject" class="form-input form-input-text" placeholder="<?php pll_e('subject', 'mandragora'); ?>*">
            </div>
            <div class="form-field-group">
                <div class="form-field form-field-select">
                    <label for="work-type" class="form-label form-label-hidden"><?php pll_e('work type', 'mandragora'); ?></label>
                    <select id="work-type" name="work-type" class="form-select">
                        <option><?php pll_e('type of work', 'mandragora'); ?></option>
                        <option value="Simple Translation"><?php pll_e('Simple Translation', 'mandragora'); ?></option>
                        <option value="Sworn Translation"><?php pll_e('Sworn Translation', 'mandragora'); ?></option>
                        <option value="Interpreting Services"><?php pll_e('Interpreting Services', 'mandragora'); ?></option>
                        <option value="Proofreading and Editing"><?php pll_e('Proofreading and Editing', 'mandragora'); ?></option>
                        <option value="Transcription and Editing"><?php pll_e('Transcription and Editing', 'mandragora'); ?></option>
                        <option value="Other"><?php pll_e('Other Enquiries', 'mandragora'); ?></option>
                    </select>
                </div>
                <div class="form-field">
                    <label for="delivery-date" class="form-label form-label-hidden"><?php pll_e('delivery date', 'mandragora'); ?></label>
                    <input id="delivery-date" name="delivery-date" class="form-input form-input-date" placeholder="<?php pll_e('delivery date', 'mandragora'); ?>">
                </div>
                <div class="form-field form-field-select">
                    <label for="collection-method" class="form-label form-label-hidden"><?php pll_e('collection method', 'mandragora'); ?></label>
                    <select id="collection-method" name="collection-method" class="form-select collection-method">
                        <option><?php pll_e('collection method', 'mandragora'); ?></option>
                        <option value="email"><?php pll_e('Email', 'mandragora'); ?></option>
                        <option value="in person"><?php pll_e('In person', 'mandragora'); ?></option>
                        <option value="post"><?php pll_e('By post', 'mandragora'); ?></option>
                    </select>
                </div>
            </div>
            <div class="form-field-group address-fields" style="display:none">
                <div class="form-field-group">
                    <div class="form-field">
                        <label for="address" class="form-label form-label-hidden"><?php pll_e('address', 'mandragora'); ?></label>
                        <input id="address" name="address" class="form-input form-input-text" placeholder="<?php pll_e('address', 'mandragora'); ?>*">
                    </div>
                    <div class="form-field">
                        <label for="city" class="form-label form-label-hidden"><?php pll_e('city', 'mandragora'); ?></label>
                        <input id="city" name="city" class="form-input form-input-text" placeholder="<?php pll_e('city', 'mandragora'); ?>*">
                    </div>
                </div>
                <div class="form-field-group">
                    <div class="form-field">
                        <label for="country" class="form-label form-label-hidden"><?php pll_e('country', 'mandragora'); ?></label>
                        <input id="country" name="country" class="form-input form-input-text" placeholder="<?php pll_e('country', 'mandragora'); ?>*">
                    </div>
                    <div class="form-field">
                        <label for="zip-code" class="form-label form-label-hidden"><?php pll_e('zip code', 'mandragora'); ?></label>
                        <input id="zip-code" name="zip-code" class="form-input form-input-text" placeholder="<?php pll_e('zip code', 'mandragora'); ?>*">
                    </div>
                </div>
                <div class="form-field-group">
                    <div class="form-field form-field-select">
                        <label for="region" class="form-label form-label-hidden"><?php pll_e('region', 'mandragora'); ?></label>
                        <select id="region" name="region" class="form-select region">
                            <option><?php pll_e('region', 'mandragora'); ?></option>
                            <option value="Singapore"><?php pll_e('Singapore', 'mandragora'); ?></option>
                            <option value="Malaysia"><?php pll_e('Malaysia', 'mandragora'); ?></option>
                            <option value="Rest of South East Asia, Hong Kong, Taiwan, Macau"><?php pll_e('Rest of South East Asia, Hong Kong, Taiwan, Macau', 'mandragora'); ?></option>
                            <option value="Rest of Asia, Australia, New Zealand"><?php pll_e('Rest of Asia, Australia, New Zealand', 'mandragora'); ?></option>
                            <option value="Europe, USA, Canada, Mexico"><?php pll_e('Europe, USA, Canada, Mexico', 'mandragora'); ?></option>
                            <option value="Rest of the World"><?php pll_e('Rest of the World', 'mandragora'); ?></option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-field form-field-file" data-file="<?php pll_e('upload document', 'mandragora'); ?>">
                <label for="file" class="form-label form-label-hidden"><?php pll_e('upload document', 'mandragora'); ?></label>
                <input id="file" name="attachment" class="form-input form-input-file" type="file" placeholder="<?php pll_e('browse', 'mandragora'); ?>*">
            </div>
            <div class="form-field">
                <label for="message" class="form-label"><?php pll_e('message', 'mandragora'); ?>*</label>
                <textarea required id="message" name="message" class="form-textarea"></textarea>
            </div>
            <label class="form-label form-label-hidden" for="checking"><?php pll_e('If you want to submit this form, do not enter anything in this field', 'mandragora'); ?> <input type="text" name="checking" id="checking" value="<?php if(isset($_POST['checking'])) echo $_POST['checking'];?>" /></label>
            <div class="form-footnote">*<?php pll_e('required', 'mandragora'); ?></div>
            <button name="submit" type="submit" class="button button-primary button-large button-send"><?php pll_e('Send enquiry', 'mandragora'); ?></button>
        </form>
    </section>
<?php endwhile; endif; ?>
</main>
<?php get_footer(); ?>