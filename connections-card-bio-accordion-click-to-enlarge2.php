<?php
/**
 * Plugin Name:       Connections Accordion Click to Enlarge2 - Template
 * Plugin URI:        http://www.chem.ufl.edu
 * Description:       This is a variation of the default template which shows the bio field for an entry.
 * Version:           1.0
 * Author:            Steven M. Kobb
 * Author URI:        http://connections-pro.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

function getHtmlTagArray2($htmlTag) {
	##parse html tag into an array of paramaters=>values
	##print("*test: <pre>htmlTag1=$htmlTag</pre><br />\n");
	$htmlTag = str_replace('<img ', '"img" ', $htmlTag);
	##print("*test: htmlTag2=$htmlTag<br />\n");
	$htmlTag = str_replace('<', ' ', $htmlTag);
	$htmlTag = str_replace('>', ' ', $htmlTag);
	##print("*test: htmlTag3=$htmlTag<br />\n");
	$paramArray = explode("\" ", $htmlTag);
	$htmlTagArray = '';
	if (is_array($paramArray)) {
		while($current = each($paramArray)) {
			$key = $current['key'];
			$value = trim($current['value']);
			##print("*test: $key=$value<br/>\n");
			if (strstr($value, '=')) {
				list($thiskey, $thisvalue) = explode("=", $value);
				$thiskey = trim($thiskey);
				$thisvalue = trim($thisvalue);
				$thisvalue = str_replace('"', '', $thisvalue);
				$thisvalue = str_replace("'", '', $thisvalue);
				if (($thiskey) AND ($thisvalue)) { $htmlTagArray[$thiskey] = $thisvalue; }
			}
		}
	}
	return($htmlTagArray);
} ##END function getHtmlTagArray($imgTag)

function cn_remove_list_no_result_message3() {
    remove_action( 'cn_list_no_results', array( 'cnTemplatePart', 'noResults' ), 10 );
}

add_action( 'plugins_loaded', 'cn_remove_list_no_result_message3', 12 );


if ( ! class_exists( 'CN_Bio_Card_Accordion_Enlarge2_Template' ) ) {

	class CN_Bio_Card_Accordion_Enlarge2_Template {

		public static function register() {

			$atts = array(
				'class'       => 'CN_Bio_Card_Accordion_Enlarge2_Template',
				'name'        => 'Bio Entry Accordion Card Accordion-click-to-enlarge2',
				'slug'        => 'card-bio-accordion-click-to-enlarge2',
				'type'        => 'all',
				'version'     => '2.0.1',
				'author'      => 'Steven A. Zahm',
				'authorURL'   => 'connections-pro.com',
				'description' => 'This is a variation of the default template which shows the bio field for an entry.',
				'custom'      => TRUE,
				'path'        => plugin_dir_path( __FILE__ ),
				'url'         => plugin_dir_url( __FILE__ ),
				'thumbnail'   => 'thumbnail.png',
				'parts'       => array(),
				);

			cnTemplateFactory::register( $atts );
		}

		public function __construct( $template ) {
			$this->template = $template;

			$template->part( array( 'tag' => 'card', 'type' => 'action', 'callback' => array( __CLASS__, 'card' ) ) );
			$template->part( array( 'tag' => 'card-single', 'type' => 'action', 'callback' => array( __CLASS__, 'card' ) ) );
		}


		public static function card( $entry, $template, $atts ) {

/*

global $noResultMessage, $defaults;
$noResultMessage = 'test';
$defaults['message'] = 'test2';
print("*TEST!");
*/
			?>
<?php
global $thisCatFound;
$thisCat = strip_tags($entry->getCategoryBlock( array( 'label' => '', 'separator' => ', ', 'before' => '', 'after' => '', 'return' => TRUE ) ));
?>
<?php
$paddingBottom = '0px';
if (!$thisCatFound[$thisCat]) {
	print('<h2 style="padding-left:20px; padding-top:20px" id="squelch-taas-title-0" class="squelch-taas-group-title">');
	print($thisCat);
	print("</h2>\n");
	$paddingBottom = '0px';
	$thisCatFound[$thisCat] = TRUE;
}
?>

<div style="padding-left:40px; padding-bottom:<?php print($paddingBottom); ?>" role="tablist" id="squelch-taas-accordion-0" class="squelch-taas-accordion squelch-taas-override ui-accordion ui-widget ui-helper-reset" data-active="false" data-disabled="false" data-autoheight="false" data-collapsible="true">
<h3 tabindex="-1" aria-selected="false" aria-controls="ui-accordion-squelch-taas-accordion-0-panel-0" role="tab" class="ui-accordion-header ui-helper-reset ui-state-default ui-corner-all ui-accordion-icons" id="squelch-taas-header-0"><span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-e"></span><a href="#squelch-taas-accordion-shortcode-content-0">
<?php echo $entry->getNameBlock(array('link' => '')); ?></a></h3>
<div aria-hidden="true" aria-expanded="false" role="tabpanel" aria-labelledby="squelch-taas-header-0" id="ui-accordion-squelch-taas-accordion-0-panel-0" style="display: none;" class="squelch-taas-accordion-shortcode-content-0 ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom">
			<div class="cn-entry" style="-moz-border-radius:4px; background-color:#FFFFFF; border:1px solid #E3E3E3; color: #000000; margin:8px 0px; padding:6px; position: relative;">
				<div style="width:49%; float:left">
<?php
##$img1 = $entry->getImage();
##print("<br />\n");

$image = $entry->getImage( array( 'image' => 'photo' , 'preset' => 'thumbnail', 'return' => TRUE, 'action' => 'none' ) );

$logo=$entry->getImage( array( 'image' => 'logo', 'return' => TRUE, 'action' => 'none', 'style' => FALSE ) );

$photo=$entry->getImage( array( 'image' => 'photo' , 'preset' => 'profile', 'return' => TRUE, 'action' => 'none', 'style' => FALSE ) );

##echo $image;
##echo $logo;
##echo $photo;

list($span1, $span2, $photo, $endspan1, $endspan2) = explode("><", $photo);

$photo2 = '<' . $photo . '>';

list($span1, $span2, $logo2, $endspan1, $endspan2) = explode("><", $logo);


$logo3 = '<' . $logo2 . '>';

##echo '<a href="/wp-content/uploads/sites/33/2014/12/bilde-300x255.jpg"><img src="/wp-content/uploads/sites/33/2014/12/bilde-300x255-150x150.jpg" alt="home" class="aligncenter size-thumbnail wp-image-107" height="150" width="150"></a>
##echo 'start' . $photo . 'end';

##<span class="cn-image-style"><span style="display: block; max-width: 100%; width: 180px">
##<img src="/wp-content/uploads/sites/33/connections-images/kyle-bentz/kyle-bentz-180x180-59628f0b61c9babe89c3c0bbd16c6ede.jpg" sizes="100vw" class="cn-image logo" alt="Logo for Kyle Bentz" title="Logo for Kyle Bentz" srcset="/wp-content/uploads/sites/33/connections-images/kyle-bentz/kyle-bentz-180x180-59628f0b61c9babe89c3c0bbd16c6ede.jpg 1x" height="180" width="180">
##</span></span>



$photoTagArray = getHtmlTagArray2($photo);
$srcset = $photoTagArray['srcset'];

list($photoUrl, $mag) = explode(" ", $srcset);
$photowidth = $photoTagArray['width'];
$photoheight = $photoTagArray['height'];
$photoalt = $photoTagArray['alt'];
echo '<span class="cn-image-style"><span style="display: block; max-width: 100%; width: 180px"><a href="' . $photoUrl . '">
' . $logo3 . '</a></span></span>';

##echo '<pre>'; print_r($photoTagArray); echo '</pre>';
 ?>
					<div style="clear:both;"></div>
					<div style="margin-bottom: 10px;">
						<!--<span style="font-size:larger;font-variant: small-caps"><strong><?php echo $entry->getNameBlock(array('link' => '')); ?></strong></span>-->
						<?php $entry->getTitleBlock(); ?>
						<?php $entry->getOrgUnitBlock(); ?>
						<?php $entry->getContactNameBlock(); ?>

					</div>

						<?php $entry->getAddressBlock(); ?>
				</div>

				<div align="right">

					<?php $entry->getFamilyMemberBlock(); ?>
					<?php $entry->getPhoneNumberBlock(); ?>
					<?php $entry->getEmailAddressBlock(); ?>
					<?php $entry->getSocialMediaBlock(); ?>
					<?php $entry->getImBlock(); ?>
					<?php $entry->getLinkBlock(); ?>
					<?php $entry->getDateBlock(); ?>


				</div>

				<div style="clear:both"></div>

				<?php echo $entry->getBioBlock(); ?>
<?php
echo '<!--';
	$thisentry = $entry->getMetaBlock(array('separator' => '-', 'key' => 'Music'),'','');
echo '-->';
	echo $thisentry;
?>

				<div style="clear:both"></div>

				<div class="cn-meta" align="left" style="margin-top: 6px">

					<?php $entry->getContentBlock( $atts['content'], $atts, $template ); ?>

					<!--<div style="display: block; margin-bottom: 8px;"><?php $entry->getCategoryBlock( array( 'separator' => ', ', 'before' => '<span>', 'after' => '</span>' ) ); ?></div>-->

					<?php if ( cnSettingsAPI::get( 'connections', 'connections_display_entry_actions', 'vcard' ) ) $entry->vcard( array( 'before' => '<span>', 'after' => '</span>' ) ); ?>

					<?php
					/*

					cnTemplatePart::updated(
						array(
							'timestamp' => $entry->getUnixTimeStamp(),
							'style' => array(
								'font-size'    => 'x-small',
								'font-variant' => 'small-caps',
								'position'     => 'absolute',
								'right'        => '36px',
								'bottom'       => '8px'
							)
						)
					);

					cnTemplatePart::returnToTop( array( 'style' => array( 'position' => 'absolute', 'right' => '8px', 'bottom' => '5px' ) ) );
					*/

					?>

				</div>

			</div>
</div>
</div>

			<?php
		}

	}

	// Register the template.
	add_action( 'cn_register_template', array( 'CN_Bio_Card_Accordion_Enlarge2_Template', 'register' ) );
}
