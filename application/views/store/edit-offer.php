<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	
	<!-- Favicon -->

	<title>Offerredeem - Update offer</title>
<link rel='stylesheet' id='buttons-css'  href='<?php echo base_url() ?>asset/css/buttons.min.css?ver=4.6.3' type='text/css' media='all' />
<link rel='stylesheet' id='mediaelement-css'  href='<?php echo base_url() ?>asset/js/mediaelement/mediaelementplayer.min.css?ver=2.22.0' type='text/css' media='all' />
<link rel='stylesheet' id='wp-mediaelement-css'  href='<?php echo base_url() ?>asset/js/mediaelement/wp-mediaelement.min.css?ver=4.6.3' type='text/css' media='all' />
<link rel='stylesheet' id='media-views-css'  href='<?php echo base_url() ?>asset/css/media-views.min.css?ver=4.6.3' type='text/css' media='all' />
<link rel='stylesheet' id='imgareaselect-css'  href='<?php echo base_url() ?>asset/js/imgareaselect/imgareaselect.css?ver=0.9.8' type='text/css' media='all' />



<?php $this->load->view('public/includes/head'); ?>

</head>
<body class="page page-id-558 page-template page-template-page-tpl_my_profile page-template-page-tpl_my_profile-php logged-in admin-bar customize-support">
<?php $this->load->view('public/includes/header'); ?>

 <section class="page-title">
        <div class="container">
            <div class="clearfix">
                <div class="pull-left">
                    <h1>
                        Edit Offer			
                   </h1>
                </div>
                <div class="pull-right">
                    <ul class="breadcrumb">
                    <li><a href="<?php echo base_url()?>store/index">Offers</a></li>
                    <li>Edit</li>
                    </ul>			
               </div>
            </div>
        </div>
    </section>
        <section>
        <div class="container">
            <div class="row">
    
                <div class="col-md-4">
    
              <?php $this->load->view('store/sidebar'); ?>
    
                </div>
    

            <div class="col-md-8"> 
                
<div class="white-block">
    <div class="white-block-content">
        <h4><i class="fa fa-pencil"></i> 
        Update Offer</h4>
    </div>
</div>

<div class="ajax-response ad-manage"> 
    <?php
            $error  = $this->session->flashdata('error');
            if(isset($error)){
                echo $error;
            }
			$success=$this->session->flashdata('success');
			if($success!=""){
				echo $success;
			}
			?>
            </div>

<!-- Nav tabs -->
<ul class="nav nav-tabs tab-disable" role="tablist">
    <li role="presentation" class="active">
        <a href="#basic" aria-controls="basic" role="tab" data-toggle="tab">
            1. Basic        </a>
    </li>
    <li role="presentation">
        <a href="#location" aria-controls="location" role="tab" data-toggle="tab">
            2. Location        
        </a>
    </li>
    <li role="presentation">
        <a href="#category" aria-controls="category" role="tab" data-toggle="tab">
            3. Category        
        </a>
    </li>
    <li role="presentation">
        <a href="#media" aria-controls="media" role="tab" data-toggle="tab">
            4. Media        
        </a>
    </li>

            <?php /*?><li role="presentation">
            <a href="#terms" aria-controls="terms" role="tab" data-toggle="tab">
                5. Terms            </a>
        </li>   <?php */?>     
    
        	<li role="presentation">
	        <a href="#final" aria-controls="final" role="tab" data-toggle="tab">
            	5. Final        	</a>
    	</li>    	
   	</ul>



<!-- Tab panes -->
<?php $offer_result=$offer_data->result();   $offer_row=$offer_result[0]; ?>
<form method="post" enctype="multipart/form-data" action="<?php echo base_url() ?>offer/update">
        <div class="white-block">
        <div class="white-block-content">
            <div class="tab-content">

                <div role="tabpanel" class="tab-pane active" id="basic">

                    <div class="row">
                        <div class="col-md-6">
                            <label for="ad_title">Offer Title <span class="required">*</span></label>
                            <p class="description">Input title of the offer which must be unique</p>
                            <input type="text" name="ad_title" id="ad_title" value="<?php echo $offer_row->title; ?>" class="form-control require">
                            
                        </div>
                        <div class="col-md-6">
                            <label>Offer thumbnail Image</label>
                            <p class="description">Select main image for the offer</p>
                            <div class="image-wrap">
                             <?php if($offer_row->main_img!=""){ ?> <img src="<?php echo base_url() ?>image_upload/<?php echo $offer_row->main_img; ?>" width="100"/> <?php } ?>
                            </div>
                            <input type="hidden" name="old_img" value="<?php echo $offer_row->main_img; ?>" />
                            <a href="javascript:;" class="btn set-image" onClick="jQuery(this).next().click();">FEATURED IMAGE</a>
                            <input type="file" name="main_image" id="featured_image"  class="form-control" style="display:none" />
                            
                        </div>
                    </div>

                    <label for="offerdesc">Offer Description <span class="required">*</span></label>
                    <p class="description">Add desciption of the offer</p>
                    <div id="wp-ad_description-wrap" class="wp-core-ui wp-editor-wrap tmce-active">

<div id="wp-ad_description-editor-container" class="wp-editor-container"><div id="qt_ad_description_toolbar" class="quicktags-toolbar"></div><textarea class="wp-editor-area" style="height: 200px" autocomplete="off" cols="40" name="ad_description" id="offerdesc"><?php echo $offer_row->offer_desc; ?></textarea></div>
</div>

 
                    <br/>
					<label for="ad_points">Offerredeem points </label>
                    <p class="description">Add points gained per purchase in % </p>
                    <input type="text" name="ad_points" id="ad_points" value="<?php echo $offer_row->offer_points; ?>" class="form-control"> 
                    <br/>
                    <label for="ad_tags">Tags / Keywords</label>
                    <p class="description">Input comma separated tags</p>
                    <input type="text" name="ad_tags" id="ad_tags" value="<?php echo $offer_row->tags; ?>" class="form-control">                            
                    

                	<div class="row">
                		<div class="col-md-6">
                            <label for="ad_price">Price</label>
                            <p class="description">Input price of the product / service you are offering (number only). Put 0 for free</p>
                            <input type="text" name="ad_price" id="ad_price" value="<?php echo $offer_row->price; ?>" class="form-control">
                            
                		</div>
                		<div class="col-md-6">
                            <label for="ad_discounted_price">Discounted Price</label>
                            <p class="description">Input discounted price of the product / service you are offering, if it exists (number only)</p>
                            <input type="text" name="ad_off_price" id="ad_discounted_price" value="<?php echo $offer_row->off_price; ?>" class="form-control">                			
                           
                		</div>
                	</div>             	
                    <div class="row">
                        <div class="col-md-6">
                            <div class="checkbox">
                                <input type="checkbox" name="ad_call_for_price" id="ad_call_for_price" value="1" <?php if($offer_row->call_price==1){echo 'checked="checked"';} ?>>
                                <label for="ad_call_for_price" style="margin-bottom:20px;">Call For Info </label>
                                <p class="description">If this is checked then Call For Info text will be displayed instead of price</p>
                            </div>
                        </div>                    
                        <div class="col-md-6">
                            <label for="ad_phone">Offer Phone</label>
                            <p class="description">Input phone number specific for this ad or leave empty to use the one from your profile</p>
                            <input type="text" name="ad_phone" id="ad_phone" value="<?php echo $offer_row->offer_phone; ?>" class="form-control">
                            
                        </div>
                    </div> 

                        <div class="next-prev-tab text-right">
        <a href="javascript:;" class="btn prev-tab disabled">
            PREVIOUS        </a>
        <a href="javascript:;" class="btn next-tab">
            NEXT        </a>
        <p class="next-prev-error hidden">
        	You have to populate all required fields. Required fields are marked with *        </p>
    </div>
    
                </div>

                <div role="tabpanel" class="tab-pane" id="location">
                	<div style="margin-bottom:20px">
                <label for="set_location">Select Location</label>
                <select name="set_location" class="form-control require" id="set_location">
                	<option value="">Select</option>
                     <?php foreach($locations->result() as $loc) { ?>
                    <option value="<?php echo $loc->location_id; ?>" <?php if($offer_row->location_id==$loc->location_id){ echo 'selected';} ?>><?php echo $loc->location_name; ?></option>
                    <?php } ?>
                </select>
                </div>
                    <div class="gmap">
                        <label for="gmap_input">Location <span class="required">*</span></label>
                        <input type="text" name="gmap_input" id="gmap_input" value="" class="form-control gmap_input">
                        <div id="map"></div>
                        <p class="description">Set location of the ad</p>
                         <?php $location=explode(",",$offer_row->location); ?>
                        <input type="hidden" name="ad_gmap_longitude" value="<?php echo $location[0]; ?>" class="longitude require">
                        <input type="hidden" name="ad_gmap_latitude" value="<?php echo $location[1]; ?>" class="latitude require">
                    </div>

                        <div class="next-prev-tab text-right">
        <a href="javascript:;" class="btn prev-tab disabled">
            PREVIOUS        </a>
        <a href="javascript:;" class="btn next-tab">
            NEXT        </a>
        <p class="next-prev-error hidden">
        	You have to populate all required fields. Required fields are marked with *        </p>
    </div>
    
                </div>

                <div role="tabpanel" class="tab-pane" id="category">
                	<label for="ad_category">Ad Category<span class="required">*</span></label>
                	<select name="ad_category" class="form-control require" id="ad_category">
                		<option value="">- Select -</option>
                		<?php foreach ($categories->result() as $cat){ ?> 
                        <option value="<?php echo $cat->category_id; ?>" <?php if($offer_row->off_category==$cat->category_id){echo 'selected="selected"';} ?>><?php echo $cat->cat_name; ?></option>  
                        <?php } ?>   
                   </select>
                    <p class="description">Select category of the ad</p>
                	<div class="custom-fields-holder"></div>

                        <div class="next-prev-tab text-right">
                            <a href="javascript:;" class="btn prev-tab disabled">
                                PREVIOUS        </a>
                            <a href="javascript:;" class="btn next-tab">
                                NEXT        </a>
                            <p class="next-prev-error hidden">
                                You have to populate all required fields. Required fields are marked with *        
                            </p>
                        </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="media">
                    <label for="ad_images">
                        Ad Images                        ( Max 12 images )                         
                    </label>
                    <div class="ad-images-wrap">
                     <?php $off_img_arr=explode(",",$offer_row->off_imgs);  $cnt=0; foreach($off_img_arr as $med_img){ if($med_img!=""){ ?>
                     <img width="80" src="<?php echo base_url()?>image_upload/<?php echo $med_img; ?>" />
                     <a href="javascript:;" class="remove-img" style=" display:inline-block" onClick="jQuery(this).next().remove(); jQuery(this).prev().remove(); jQuery(this).hide();">X</a>
                     <input type="hidden" name="old_off_imgs[]" value="<?php echo $med_img; ?>" />
                     <?php $cnt++; } }?>
                     </div>
                    <a href="javascript:;" class="btn ad-images" onClick="jQuery(this).next().click();">SELECT IMAGES</a>
                    <input type="file" name="media_imgs[]" id="media_images"  class="form-control" style="display:none" multiple />
                    <p class="description">Select additional images for the ad</p>
                    <p>&nbsp;</p>
                    <label>
                        Ad Videos                        ( Max 3 videos ) 
                    </label>
                    <?php $vid_arr=explode(",",$offer_row->off_videos); foreach($vid_arr as $vid){ if($vid!=""){ ?>
                    <div class="ad-video-wrap">
                        <div class="ad-video-field-wrap" style="position:relative">
                            <input type="text" class="form-control" name="ad_videos[]" value="<?php echo $vid; ?>" style="width:90%; position:relative">
                            <a href="javascript:;" class="remove-video" style="position: absolute; right: 0;bottom: 1px; padding: 12px 22px;">X</a>
                        </div>
                        <p class="description">Youtube or vimeo links</p>
                    </div>  
					<?php } }?>
                    <div class="ad-video-wrap hidden">
                        <div class="ad-video-field-wrap">
                            <input type="text" class="form-control" name="ad_videos[]" value="">
                            <a href="javascript:;" class="remove-video">X</a>
                        </div>
                        <p class="description">Youtube or vimeo links</p>
                    </div>                    
                    <div class="ad-media-wrap">
                                            </div>
                    <a href="javascript:;" class="btn ad-videos">ADD VIDEOS</a>
                    <p class="description">Select additional videos for the ad</p>

                        <div class="next-prev-tab text-right">
        <a href="javascript:;" class="btn prev-tab disabled">
            PREVIOUS        </a>
        <a href="javascript:;" class="btn next-tab">
            NEXT        </a>
        <p class="next-prev-error hidden">
        	You have to populate all required fields. Required fields are marked with *        
        </p>
    </div>
    
                </div>

                                    <div role="tabpanel" class="tab-pane" id="terms" style="display:none">

                        <div class="terms-wrap">
                            <h4>Terms of Use</h4>
<h6>Legal Notices</h6>
<p>We, the Operators of this Website, provide it as a public service to our users.</p>
<p>Please carefully review the following basic rules that govern your use of the Website. Please note that your use of the Website constitutes your unconditional agreement to follow and be bound by these Terms and Conditions of Use. If you (the &#8220;User&#8221;) do not agree to them, do not use the Website, provide any materials to the Website or download any materials from them.</p>
<p>The Operators reserve the right to update or modify these Terms and Conditions at any time without prior notice to User. Your use of the Website following any such change constitutes your unconditional agreement to follow and be bound by these Terms and Conditions as changed. For this reason, we encourage you to review these Terms and Conditions of Use whenever you use the Website.</p>
<p>These Terms and Conditions of Use apply to the use of the Website and do not extend to any linked third party sites. These Terms and Conditions and our <a href="http://default-template.wikidot.com/legal:privacy-policy">Privacy Policy</a>, which are hereby incorporated by reference, contain the entire agreement (the “Agreement”) between you and the Operators with respect to the Website. Any rights not expressly granted herein are reserved.</p>
<h6>Permitted and Prohibited Uses</h6>
<p>You may use the the Website for the sole purpose of sharing and exchanging ideas with other Users. You may not use the the Website to violate any applicable local, state, national, or international law, including without limitation any applicable laws relating to antitrust or other illegal trade or business practices, federal and state securities laws, regulations promulgated by the U.S. Securities and Exchange Commission, any rules of any national or other securities exchange, and any U.S. laws, rules, and regulations governing the export and re-export of commodities or technical data.</p>
<p>You may not upload or transmit any material that infringes or misappropriates any person&#8217;s copyright, patent, trademark, or trade secret, or disclose via the the Website any information the disclosure of which would constitute a violation of any confidentiality obligations you may have.</p>
<p>You may not upload any viruses, worms, Trojan horses, or other forms of harmful computer code, nor subject the Website&#8217;s network or servers to unreasonable traffic loads, or otherwise engage in conduct deemed disruptive to the ordinary operation of the Website.</p>
<p>You are strictly prohibited from communicating on or through the Website any unlawful, harmful, offensive, threatening, abusive, libelous, harassing, defamatory, vulgar, obscene, profane, hateful, fraudulent, sexually explicit, racially, ethnically, or otherwise objectionable material of any sort, including, but not limited to, any material that encourages conduct that would constitute a criminal offense, give rise to civil liability, or otherwise violate any applicable local, state, national, or international law.</p>
<p>You are expressly prohibited from compiling and using other Users&#8217; personal information, including addresses, telephone numbers, fax numbers, email addresses or other contact information that may appear on the Website, for the purpose of creating or compiling marketing and/or mailing lists and from sending other Users unsolicited marketing materials, whether by facsimile, email, or other technological means.</p>
<p>You also are expressly prohibited from distributing Users&#8217; personal information to third-party parties for marketing purposes. The Operators shall deem the compiling of marketing and mailing lists using Users&#8217; personal information, the sending of unsolicited marketing materials to Users, or the distribution of Users&#8217; personal information to third parties for marketing purposes as a material breach of these Terms and Conditions of Use, and the Operators reserve the right to terminate or suspend your access to and use of the Website and to suspend or revoke your membership in the consortium without refund of any membership dues paid.</p>
<p>The Operators note that unauthorized use of Users&#8217; personal information in connection with unsolicited marketing correspondence also may constitute violations of various state and federal anti-spam statutes. The Operators reserve the right to report the abuse of Users&#8217; personal information to the appropriate law enforcement and government authorities, and the Operators will fully cooperate with any authorities investigating violations of these laws.</p>
<h6>User Submissions</h6>
<p>The Operators do not want to receive confidential or proprietary information from you through the Website. Any material, information, or other communication you transmit or post (&#8220;Contributions&#8221;) to the Website will be considered non-confidential.</p>
<p>All contributions to this site are licensed by you under the MIT License to anyone who wishes to use them, including the Operators.</p>
<p>If you work for a company or at a University, it&#8217;s likely that you&#8217;re not the copyright holder of anything you make, even in your free time. Before making contributions to this site, get written permission from your employer.</p>
<h6>User Discussion Lists and Forums</h6>
<p>The Operators may, but are not obligated to, monitor or review any areas on the Website where users transmit or post communications or communicate solely with each other, including but not limited to user forums and email lists, and the content of any such communications. The Operators, however, will have no liability related to the content of any such communications, whether or not arising under the laws of copyright, libel, privacy, obscenity, or otherwise. The Operators may edit or remove content on the the Website at their discretion at any time.</p>
<h6>Use of Personally Identifiable Information</h6>
<p>Information submitted to the Website is governed according to the Operators’s current <a href="http://default-template.wikidot.com/legal:privacy-policy">Privacy Policy</a> and the stated license of this website.</p>
<p>You agree to provide true, accurate, current, and complete information when registering with the Website. It is your responsibility to maintain and promptly update this account information to keep it true, accurate, current, and complete. If you provides any information that is fraudulent, untrue, inaccurate, incomplete, or not current, or we have reasonable grounds to suspect that such information is fraudulent, untrue, inaccurate, incomplete, or not current, we reserve the right to suspend or terminate your account without notice and to refuse any and all current and future use of the Website.</p>
<p>Although sections of the Website may be viewed simply by visiting the Website, in order to access some Content and/or additional features offered at the Website, you may need to sign on as a guest or register as a member. If you create an account on the Website, you may be asked to supply your name, address, a User ID and password. You are responsible for maintaining the confidentiality of the password and account and are fully responsible for all activities that occur in connection with your password or account. You agree to immediately notify us of any unauthorized use of either your password or account or any other breach of security. You further agree that you will not permit others, including those whose accounts have been terminated, to access the Website using your account or User ID. You grant the Operators and all other persons or entities involved in the operation of the Website the right to transmit, monitor, retrieve, store, and use your information in connection with the operation of the Website and in the provision of services to you. The Operators cannot and do not assume any responsibility or liability for any information you submit, or your or third parties’ use or misuse of information transmitted or received using website. To learn more about how we protect the privacy of the personal information in your account, please visit our <a href="http://default-template.wikidot.com/legal:privacy-policy">Privacy Policy</a>.</p>
<h6>Indentification</h6>
<p>You agree to defend, indemnify and hold harmless the Operators, agents, vendors or suppliers from and against any and all claims, damages, costs and expenses, including reasonable attorneys&#8217; fees, arising from or related to your use or misuse of the Website, including, without limitation, your violation of these Terms and Conditions, the infringement by you, or any other subscriber or user of your account, of any intellectual property right or other right of any person or entity.</p>
<h6>Termination</h6>
<p>These Terms and Conditions of Use are effective until terminated by either party. If you no longer agree to be bound by these Terms and Conditions, you must cease use of the Website. If you are dissatisfied with the Website, their content, or any of these terms, conditions, and policies, your sole legal remedy is to discontinue using the Website. The Operators reserve the right to terminate or suspend your access to and use of the Website, or parts of the Website, without notice, if we believe, in our sole discretion, that such use (i) is in violation of any applicable law; (ii) is harmful to our interests or the interests, including intellectual property or other rights, of another person or entity; or (iii) where the Operators have reason to believe that you are in violation of these Terms and Conditions of Use.</p>
<h6>WARRANTY DISCLAIMER</h6>
<p>THE WEBSITE AND ASSOCIATED MATERIALS ARE PROVIDED ON AN &#8220;AS IS&#8221; AND &#8220;AS AVAILABLE&#8221; BASIS. TO THE FULL EXTENT PERMISSIBLE BY APPLICABLE LAW, THE OPERATORS DISCLAIM ALL WARRANTIES, EXPRESS OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE, OR NON-INFRINGEMENTOF INTELLECTUAL PROPERTY. THE OPERATORS MAKE NO REPRESENTATIONS OR WARRANTY THAT THE WEBSITE WILL MEET YOUR REQUIREMENTS, OR THAT YOUR USE OF THE WEBSITE WILL BE UNINTERRUPTED, TIMELY, SECURE, OR ERROR FREE; NOR DO THE OPERATORS MAKE ANY REPRESENTATION OR WARRANTY AS TO THE RESULTS THAT MAY BE OBTAINED FROM THE USE OF THE WEBSITE. THE OPERATORS MAKE NO REPRESENTATIONS OR WARRANTIES OF ANY KIND, EXPRESS OR IMPLIED, AS TO THE OPERATION OF THE WEBSITE OR THE INFORMATION, CONTENT, MATERIALS, OR PRODUCTS INCLUDED ON THE WEBSITE.</p>
<p>IN NO EVENT SHALL THE OPERATORS OR ANY OF THEIR AGENTS, VENDORS OR SUPPLIERS BE LIABLE FOR ANY DAMAGES WHATSOEVER (INCLUDING, WITHOUT LIMITATION, DAMAGES FOR LOSS OF PROFITS, BUSINESS INTERRUPTION, LOSS OF INFORMATION) ARISING OUT OF THE USE, MISUSE OF OR INABILITY TO USE THE WEBSITE, EVEN IF THE OPERATORS HAVE BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES. THIS DISCLAIMER CONSTITUTES AN ESSENTIAL PART OF THIS AGREEMENT. BECAUSE SOME JURISDICTIONS PROHIBIT THE EXCLUSION OR LIMITATION OF LIABILITY FOR CONSEQUENTIAL OR INCIDENTAL DAMAGES, THE ABOVE LIMITATION MAY NOT APPLY TO YOU.</p>
<p>YOU UNDERSTAND AND AGREE THAT ANY CONTENT DOWNLOADED OR OTHERWISE OBTAINED THROUGH THE USE OF THE WEBSITE IS AT YOUR OWN DISCRETION AND RISK AND THAT YOU WILL BE SOLELY RESPONSIBLE FOR ANY DAMAGE TO YOUR COMPUTER SYSTEM OR LOSS OF DATA OR BUSINESS INTERRUPTION THAT RESULTS FROM THE DOWNLOAD OF CONTENT. THE OPERATORS SHALL NOT BE RESPONSIBLE FOR ANY LOSS OR DAMAGE CAUSED, OR ALLEGED TO HAVE BEEN CAUSED, DIRECTLY OR INDIRECTLY, BY THE INFORMATION OR IDEAS CONTAINED, SUGGESTED OR REFERENCED IN OR APPEARING ON THE WEBSITE. YOUR PARTICIPATION IN THE WEBSITE IS SOLELY AT YOUR OWN RISK. NO ADVICE OR INFORMATION, WHETHER ORAL OR WRITTEN, OBTAINED BY YOU FROM THE OPERATORS OR THROUGH THE OPERATORS, THEIR EMPLOYEES, OR THIRD PARTIES SHALL CREATE ANY WARRANTY NOT EXPRESSLY MADE HEREIN. YOU ACKNOWLEDGE, BY YOUR USE OF THE THE WEBSITE, THAT YOUR USE OF THE WEBSITE IS AT YOUR SOLE RISK.</p>
<p>LIABILITY LIMITATION. UNDER NO CIRCUMSTANCES AND UNDER NO LEGAL OR EQUITABLE THEORY, WHETHER IN TORT, CONTRACT, NEGLIGENCE, STRICT LIABILITY OR OTHERWISE, SHALL THE OPERATORS OR ANY OF THEIR AGENTS, VENDORS OR SUPPLIERS BE LIABLE TO USER OR TO ANY OTHER PERSON FOR ANY INDIRECT, SPECIAL, INCIDENTAL OR CONSEQUENTIAL LOSSES OR DAMAGES OF ANY NATURE ARISING OUT OF OR IN CONNECTION WITH THE USE OF OR INABILITY TO USE THE THE WEBSITE OR FOR ANY BREACH OF SECURITY ASSOCIATED WITH THE TRANSMISSION OF SENSITIVE INFORMATION THROUGH THE WEBSITE OR FOR ANY INFORMATION OBTAINED THROUGH THE WEBSITE, INCLUDING, WITHOUT LIMITATION, DAMAGES FOR LOST PROFITS, LOSS OF GOODWILL, LOSS OR CORRUPTION OF DATA, WORK STOPPAGE, ACCURACY OF RESULTS, OR COMPUTER FAILURE OR MALFUNCTION, EVEN IF AN AUTHORIZED REPRESENTATIVE OF THE OPERATORS HAS BEEN ADVISED OF OR SHOULD HAVE KNOWN OF THE POSSIBILITY OF SUCH DAMAGES.</p>
<p>THE OPERATORS&#8217;S TOTAL CUMULATIVE LIABILITY FOR ANY AND ALL CLAIMS IN CONNECTION WITH THE WEBSITE WILL NOT EXCEED FIVE U.S. DOLLARS ($5.00). USER AGREES AND ACKNOWLEDGES THAT THE FOREGOING LIMITATIONS ON LIABILITY ARE AN ESSENTIAL BASIS OF THE BARGAIN AND THAT THE OPERATORS WOULD NOT PROVIDE THE WEBSITE ABSENT SUCH LIMITATION.</p>
<h6>General</h6>
<p>The Website is hosted in the United States. The Operators make no claims that the Content on the Website is appropriate or may be downloaded outside of the United States. Access to the Content may not be legal by certain persons or in certain countries. If you access the Website from outside the United States, you do so at your own risk and are responsible for compliance with the laws of your jurisdiction. The provisions of the UN Convention on Contracts for the International Sale of Goods will not apply to these Terms. A party may give notice to the other party only in writing at that party&#8217;s principal place of business, attention of that party&#8217;s principal legal officer, or at such other address or by such other method as the party shall specify in writing. Notice shall be deemed given upon personal delivery or facsimile, or, if sent by certified mail with postage prepaid, 5 business days after the date of mailing, or, if sent by international overnight courier with postage prepaid, 7 business days after the date of mailing. If any provision herein is held to be unenforceable, the remaining provisions will continue in full force without being affected in any way. Further, the parties agree to replace such unenforceable provision with an enforceable provision that most closely approximates the intent and economic effect of the unenforceable provision. Section headings are for reference purposes only and do not define, limit, construe or describe the scope or extent of such section. The failure of the Operators to act with respect to a breach of this Agreement by you or others does not constitute a waiver and shall not limit the Operators&#8217; rights with respect to such breach or any subsequent breaches. Any action or proceeding arising out of or related to this Agreement or User&#8217;s use of the Website must be brought in the courts of Belgium, and you consent to the exclusive personal jurisdiction and venue of such courts. Any cause of action you may have with respect to your use of the Website must be commenced within one (1) year after the claim or cause of action arises. These Terms set forth the entire understanding and agreement of the parties, and supersedes any and all oral or written agreements or understandings between the parties, as to their subject matter. The waiver of a breach of any provision of this Agreement shall not be construed as a waiver of any other or subsequent breach.</p>
<h6>Links to Other Materials</h6>
<p>The Website may contain links to sites owned or operated by independent third parties. These links are provided for your convenience and reference only. We do not control such sites and, therefore, we are not responsible for any content posted on these sites. The fact that the Operators offer such links should not be construed in any way as an endorsement, authorization, or sponsorship of that site, its content or the companies or products referenced therein, and the Operators reserve the right to note its lack of affiliation, sponsorship, or endorsement on the Website. If you decide to access any of the third party sites linked to by the Website, you do this entirely at your own risk. Because some sites employ automated search results or otherwise link you to sites containing information that may be deemed inappropriate or offensive, the Operators cannot be held responsible for the accuracy, copyright compliance, legality, or decency of material contained in third party sites, and you hereby irrevocably waive any claim against us with respect to such sites.</p>
<h6>Notification Of Possible Copyright Infringement</h6>
<p>In the event you believe that material or content published on the Website may infringe on your copyright or that of another, please <a href="http://default-template.wikidot.com/contact">contact</a> us.</p>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" name="ad_terms" id="ad_terms" class="require" checked>
                            <label for="ad_terms">I have read and accept the terms </label>
                        </div>

                            <div class="next-prev-tab text-right">
        <a href="javascript:;" class="btn prev-tab disabled">
            PREVIOUS        </a>
        <a href="javascript:;" class="btn next-tab">
            NEXT        </a>
        <p class="next-prev-error hidden">
        	You have to populate all required fields. Required fields are marked with *        </p>
    </div>
    
                    </div>
                

                                    <div role="tabpanel" class="tab-pane" id="final">

                    	<div class="alert alert-info">
                    		<p>Each ad will last for 30 days.</p>
                            <hr />
                    		<p class="clearfix">
                                <span class="pull-left">Basic ad:</span>
                                <span class="pull-right">$0.00</span>
                            </p>
                            <p class="clearfix featured-info hidden">
                                <span class="pull-left">Featured ad:</span>
                                <span class="pull-right">$5.00</span>
                            </p>
                            <p class="clearfix">
                                <span class="pull-left">Total:</span>
                                <span class="pull-right total-amount" data-basic="$0.00" data-featured="$5.00">$0.00</span>
                            </p>                    	
                        </div>

                    	<div class="checkbox">
                            <input type="checkbox" name="ad_featured" id="ad_featured" value="1" <?php if($offer_row->featured=="1"){echo 'checked="checked"';} ?>>
                            <label for="ad_featured">Make ad featured</label>
                         </div>
                         <input type="hidden" name="offer_id" value="<?php echo $offer_row->offer_id; ?>" />
                            <button type="submit" class="btn ">
                                UPDATE OFFER                            
                            </button>
    <div class="next-prev-tab text-right">
        <a href="javascript:;" class="btn prev-tab disabled">
            PREVIOUS        </a>
        <a href="javascript:;" class="btn next-tab">
            NEXT        </a>
        <p class="next-prev-error hidden">
        	You have to populate all required fields. Required fields are marked with *        </p>
    </div>
</div>
                
            </div>
            <input type="hidden" name="post_id" value="0">
            <input type="hidden" name="ad_views" value="0">
            <input type="hidden" value="update_ad" name="action">

                          

        </div>
    </div>
</form>            </div>
    
            </div>
        </div>
    </section>
		

<?php $this->load->view('public/includes/footer'); ?>
<?php $this->load->view('public/includes/footer-js'); ?>

<script type='text/javascript' src='<?php echo base_url() ?>asset/js/underscore.min.js?ver=1.8.3'></script>
<script type='text/javascript' src='<?php echo base_url() ?>asset/js/shortcode.min.js?ver=4.6.3'></script>
<script type='text/javascript' src='<?php echo base_url() ?>asset/js/backbone.min.js?ver=1.2.3'></script>

<script type='text/javascript' src='<?php echo base_url() ?>asset/js/wp-util.min.js?ver=4.6.3'></script>
<script type='text/javascript' src='<?php echo base_url() ?>asset/js/wp-backbone.min.js?ver=4.6.3'></script>

<script type='text/javascript' src='<?php echo base_url() ?>asset/js/jquery/ui/core.min.js?ver=1.11.4'></script>
<script type='text/javascript' src='<?php echo base_url() ?>asset/js/jquery/ui/widget.min.js?ver=1.11.4'></script>
<script type='text/javascript' src='<?php echo base_url() ?>asset/js/jquery/ui/mouse.min.js?ver=1.11.4'></script>
<script type='text/javascript' src='<?php echo base_url() ?>asset/js/jquery/ui/sortable.min.js?ver=1.11.4'></script>

<script type='text/javascript' src='<?php echo base_url() ?>asset/classifieds/js/image-uploader.js?ver=4.6.3'></script>
<script type='text/javascript' src='<?php echo base_url() ?>asset/classifieds/js/gmap.js?ver=4.6.3'></script>
<script type='text/javascript' src='<?php echo base_url() ?>asset/classifieds/js/custom-fields.js?ver=4.6.3'></script>

<script type='text/javascript' src='<?php echo base_url() ?>asset/js/quicktags.min.js?ver=4.6.3'></script>
<script type='text/javascript' src='<?php echo base_url() ?>asset/js/wp-a11y.min.js?ver=4.6.3'></script>

<script type='text/javascript' src='<?php echo base_url() ?>asset/js/wplink.min.js?ver=4.6.3'></script>
<script type='text/javascript' src='<?php echo base_url() ?>asset/js/jquery/ui/position.min.js?ver=1.11.4'></script>
<script type='text/javascript' src='<?php echo base_url() ?>asset/js/jquery/ui/menu.min.js?ver=1.11.4'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var uiAutocompleteL10n = {"noResults":"No search results.","oneResult":"1 result found. Use up and down arrow keys to navigate.","manyResults":"%d results found. Use up and down arrow keys to navigate."};
/* ]]> */
</script>
<script type='text/javascript' src='<?php echo base_url() ?>asset/js/jquery/ui/autocomplete.min.js?ver=1.11.4'></script>

<script type='text/javascript' src='<?php echo base_url() ?>asset/js/thickbox/thickbox.js?ver=3.1-20121105'></script>
<script type='text/javascript' src='<?php echo base_url() ?>asset/js/media-upload.min.js?ver=4.6.3'></script>

<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<script>
jQuery(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('ad_description');
  });
</script>

</body>
</html>