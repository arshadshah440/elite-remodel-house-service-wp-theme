<?php
/**
 * Fallback content, keyed by the exact ACF field name it stands in for.
 *
 * Used by erh_option() / erh_field() so every template renders sensible
 * content before Theme Settings or the Home Page Sections panel have been
 * filled in, and even when no fields plugin is installed at all.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

/**
 * The full defaults map.
 *
 * @return array<string, mixed>
 */
function erh_defaults() {
	static $defaults = null;

	if ( null !== $defaults ) {
		return $defaults;
	}

	$placeholder = erh_placeholder_image_url();

	$defaults = array(

		// ------ Header. ------
		'header_logo'          => array( 'url' => '', 'alt' => '' ),
		'header_logo_height'   => 40,
		'header_style'         => 'solid',
		'header_cta_enable'    => true,
		'header_cta_link'      => array( 'url' => '#contact', 'title' => __( 'Contact Us', 'elite-remodel-hub' ), 'target' => '' ),

		// ------ Footer. ------
		'footer_logo'                 => array( 'url' => '', 'alt' => '' ),
		'footer_logo_height'          => 40,
		'footer_about'                => __( 'Elite Remodel Hub brings expert craftsmanship and thoughtful design together to transform houses into homes you will love coming back to.', 'elite-remodel-hub' ),
		'footer_socials'               => array(
			array( 'social_url' => 'https://facebook.com/', 'social_icon' => 'facebook', 'social_label' => 'Facebook' ),
			array( 'social_url' => 'https://instagram.com/', 'social_icon' => 'instagram', 'social_label' => 'Instagram' ),
			array( 'social_url' => 'https://x.com/', 'social_icon' => 'x', 'social_label' => 'X' ),
			array( 'social_url' => 'https://linkedin.com/', 'social_icon' => 'linkedin', 'social_label' => 'LinkedIn' ),
		),
		'footer_links_title'          => __( 'Quick Links', 'elite-remodel-hub' ),
		'footer_links_source'         => 'manual',
		'footer_links'                => array(
			array( 'link' => array( 'url' => '#services', 'title' => __( 'Our Service', 'elite-remodel-hub' ), 'target' => '' ) ),
			array( 'link' => array( 'url' => '#about', 'title' => __( 'About Us', 'elite-remodel-hub' ), 'target' => '' ) ),
			array( 'link' => array( 'url' => '#blog', 'title' => __( 'Our Blog', 'elite-remodel-hub' ), 'target' => '' ) ),
			array( 'link' => array( 'url' => '#testimonials', 'title' => __( 'Testimonial', 'elite-remodel-hub' ), 'target' => '' ) ),
		),
		'footer_contact_title'        => __( 'Contact Us', 'elite-remodel-hub' ),
		'footer_show_phone'           => true,
		'footer_show_email'           => true,
		'footer_show_address'         => true,
		'footer_newsletter_title'     => __( 'Newsletter', 'elite-remodel-hub' ),
		'footer_newsletter_placeholder' => __( 'Enter your email', 'elite-remodel-hub' ),
		'footer_newsletter_button'    => __( 'Subscribe', 'elite-remodel-hub' ),
		'footer_newsletter_action'    => '',
		'footer_copyright'            => __( '© {year} {sitename}. All Rights Reserved', 'elite-remodel-hub' ),
		'footer_legal_links'          => array(),

		// ------ Brand & Contact. ------
		'brand_phone'          => '(+1) 234 567 8900',
		'brand_email'          => 'info@eliteremodelhub.com',
		'brand_address'        => "638 Cerrit Solon\nEnglewood, NJ 07631",
		'brand_map_url'        => '',
		'brand_hours'          => __( 'Mon–Sat, 8am–6pm', 'elite-remodel-hub' ),
		'brand_primary_color'  => '#153A68',
		'brand_accent_color'   => '#F1B73E',
		'brand_ink_color'      => '#25262D',
		'brand_body_color'     => '#666A73',

		/*
		 * ------ Home page ------
		 *
		 * The live home page content is stored as Secure Custom Fields values on
		 * the page itself, edited under "Home Page Sections" in the page editor.
		 * The entries below are only the fallback: they render when a field has
		 * been left empty, or when no fields plugin is active at all. Keep them
		 * short and generic - the real copy belongs in the fields, not here.
		 *
		 * The "*_columns" entries are layout settings rather than content, so
		 * they carry the real default each card grid uses.
		 */

		// SEO.
		'seo_title'       => '',
		'seo_description' => '',

		// Hero.
		'hero_enable'          => true,
		'hero_title'           => __( 'Kitchen Remodeling Services', 'elite-remodel-hub' ),
		'hero_title_highlight' => 1,
		'hero_text'            => __( 'Add the hero introduction in the Home Page Sections panel.', 'elite-remodel-hub' ),
		'hero_text_2'          => '',
		'hero_note'            => '',
		'hero_button'          => array( 'url' => '', 'title' => __( 'Get a Free Estimate', 'elite-remodel-hub' ), 'target' => '' ),
		'hero_gallery'         => array(
			array( 'image' => array( 'url' => $placeholder, 'alt' => '' ) ),
			array( 'image' => array( 'url' => $placeholder, 'alt' => '' ) ),
			array( 'image' => array( 'url' => $placeholder, 'alt' => '' ) ),
		),

		// Intro section.
		'about_enable'          => true,
		'about_eyebrow'         => __( 'Kitchen Remodeling', 'elite-remodel-hub' ),
		'about_title'           => __( 'Complete Remodeling Solutions', 'elite-remodel-hub' ),
		'about_title_highlight' => 1,
		'about_text'            => __( 'Add the introduction copy in the Home Page Sections panel.', 'elite-remodel-hub' ),
		'about_text_2'          => '',
		'about_text_3'          => '',
		'about_text_4'          => '',
		'about_button'          => array( 'url' => '', 'title' => __( 'Read More', 'elite-remodel-hub' ), 'target' => '' ),
		'about_image_main'      => array( 'url' => $placeholder, 'alt' => '' ),
		'about_image_top'       => array( 'url' => $placeholder, 'alt' => '' ),
		'about_image_bottom'    => array( 'url' => $placeholder, 'alt' => '' ),

		// Services grid.
		'kservices_enable'          => true,
		'kservices_eyebrow'         => __( 'Our Services', 'elite-remodel-hub' ),
		'kservices_title'           => __( 'Explore Our Services', 'elite-remodel-hub' ),
		'kservices_title_highlight' => 1,
		'kservices_text'            => '',
		'kservices_columns'         => 3,
		'kservices_items'           => array(),

		// Scope checklist.
		'scope_enable'          => true,
		'scope_eyebrow'         => __( 'Project Scope', 'elite-remodel-hub' ),
		'scope_title'           => __( 'What Can a Remodel Include?', 'elite-remodel-hub' ),
		'scope_title_highlight' => 0,
		'scope_text'            => '',
		'scope_columns'         => 4,
		'scope_items'           => array(),
		'scope_note'            => '',
		'scope_note_2'          => '',

		// Planning.
		'planning_enable'          => true,
		'planning_eyebrow'         => __( 'Planning First', 'elite-remodel-hub' ),
		'planning_title'           => __( 'Starts With Better Planning', 'elite-remodel-hub' ),
		'planning_title_highlight' => 2,
		'planning_lead'            => '',
		'planning_columns'         => 1,
		'planning_items'           => array(),
		'planning_text_2'          => '',
		'planning_text_3'          => '',

		// Process.
		'process_enable'          => true,
		'process_eyebrow'         => __( 'How It Works', 'elite-remodel-hub' ),
		'process_title'           => __( 'Our Remodeling Process', 'elite-remodel-hub' ),
		'process_title_highlight' => 1,
		'process_text'            => '',
		'process_columns'         => 5,
		'process_steps'           => array(),

		// Costs.
		'cost_enable'          => true,
		'cost_eyebrow'         => __( 'Budget', 'elite-remodel-hub' ),
		'cost_title'           => __( 'Costs and Project Planning', 'elite-remodel-hub' ),
		'cost_title_highlight' => 2,
		'cost_text'            => '',
		'cost_text_2'          => '',
		'cost_text_3'          => '',
		'cost_text_4'          => '',
		'cost_link'            => array( 'url' => '', 'title' => '', 'target' => '' ),
		'cost_factors_title'   => __( 'What Affects the Cost', 'elite-remodel-hub' ),
		'cost_factors'         => array(),

		// Choosing a contractor.
		'contractor_enable'          => true,
		'contractor_eyebrow'         => __( 'Hiring', 'elite-remodel-hub' ),
		'contractor_title'           => __( 'Choosing the Right Contractor', 'elite-remodel-hub' ),
		'contractor_title_highlight' => 1,
		'contractor_text'            => '',
		'contractor_text_2'          => '',
		'contractor_checklist_title' => __( 'A written proposal should identify', 'elite-remodel-hub' ),
		'contractor_checklist'       => array(),
		'contractor_text_3'          => '',
		'contractor_text_4'          => '',

		// Service areas.
		'locations_enable'          => true,
		'locations_eyebrow'         => __( 'Service Areas', 'elite-remodel-hub' ),
		'locations_title'           => __( 'Where We Work', 'elite-remodel-hub' ),
		'locations_title_highlight' => 0,
		'locations_text'            => '',
		'locations_columns'         => 4,
		'locations_items'           => array(),

		// Why choose us.
		'why_enable'          => true,
		'why_title'           => __( 'Why Choose Us?', 'elite-remodel-hub' ),
		'why_title_highlight' => 2,
		'why_text'            => '',
		'why_bg_image'        => array( 'url' => $placeholder, 'alt' => '' ),
		'why_columns'         => 3,
		'why_items'           => array(),

		// Design ideas.
		'ideas_enable'          => true,
		'ideas_eyebrow'         => __( 'Inspiration', 'elite-remodel-hub' ),
		'ideas_title'           => __( 'Design Ideas and Real Transformations', 'elite-remodel-hub' ),
		'ideas_title_highlight' => 1,
		'ideas_text'            => '',
		'ideas_text_2'          => '',
		'ideas_text_3'          => '',
		'ideas_link'            => array( 'url' => '', 'title' => '', 'target' => '' ),
		'ideas_columns'         => 2,
		'ideas_gallery'         => array(),

		// FAQ.
		'faq_enable'               => true,
		'home_faq_eyebrow'         => __( 'Good To Know', 'elite-remodel-hub' ),
		'home_faq_title'           => __( 'Frequently Asked Questions', 'elite-remodel-hub' ),
		'home_faq_title_highlight' => 1,
		'home_faq_text'            => '',
		'home_faq_items'           => array(),

		// Closing CTA.
		'cta_enable'   => true,
		'cta_title'    => __( 'Start Planning Your Remodel', 'elite-remodel-hub' ),
		'cta_text'     => '',
		'cta_button'   => array( 'url' => '', 'title' => __( 'Get a Free Estimate', 'elite-remodel-hub' ), 'target' => '' ),
		'cta_bg_image' => array( 'url' => $placeholder, 'alt' => '' ),

		// Sections that ship switched off on this home page.
		'services_enable'              => false,
		'services_title'               => __( 'Our Service', 'elite-remodel-hub' ),
		'services_title_highlight'     => 1,
		'services_text'                => '',
		'blog_enable'                  => false,
		'blog_title'                   => __( 'Our Recent Post', 'elite-remodel-hub' ),
		'blog_title_highlight'         => 1,
		'blog_text'                    => '',
		'blog_count'                   => 3,
		'testimonials_enable'          => false,
		'testimonials_title'           => __( 'What Our Client Say', 'elite-remodel-hub' ),
		'testimonials_title_highlight' => 2,
		'testimonials_text'            => '',

		// ------ About page - Banner. ------
		'about_banner_eyebrow'         => __( 'About Us', 'elite-remodel-hub' ),
		'about_banner_title'           => __( 'Building Homes, Crafting Legacies', 'elite-remodel-hub' ),
		'about_banner_title_highlight' => 2,
		'about_banner_text'            => __( 'For over two decades, Elite Remodel Hub has turned houses into homes worth coming back to - one thoughtful renovation at a time.', 'elite-remodel-hub' ),

		// ------ About page - Story. ------
		'story_eyebrow'         => __( 'Our Story', 'elite-remodel-hub' ),
		'story_title'           => __( 'Two Decades of Remodeling Excellence', 'elite-remodel-hub' ),
		'story_title_highlight' => 2,
		'story_text'            => __( 'Elite Remodel Hub started as a small family carpentry shop with one simple promise: treat every home like it was our own. That promise is still what guides every project we take on today.', 'elite-remodel-hub' ),
		'story_text_2'          => __( 'From single-room refreshes to whole-home renovations, our licensed designers and craftsmen work side by side with you, from the first sketch to the final walkthrough, so the result feels unmistakably yours.', 'elite-remodel-hub' ),
		'story_button'          => array( 'url' => '#team', 'title' => __( 'Meet the Team', 'elite-remodel-hub' ), 'target' => '' ),
		'story_image_main'      => array( 'url' => $placeholder, 'alt' => '' ),
		'story_image_top'       => array( 'url' => $placeholder, 'alt' => '' ),
		'story_image_bottom'    => array( 'url' => $placeholder, 'alt' => '' ),

		// ------ About page - Mission & Vision. ------
		'mission_title' => __( 'Our Mission', 'elite-remodel-hub' ),
		'mission_text'  => __( 'To deliver thoughtfully designed, expertly built renovations that improve how our clients actually live in their homes, on time, on budget, every time.', 'elite-remodel-hub' ),
		'vision_title'  => __( 'Our Vision', 'elite-remodel-hub' ),
		'vision_text'   => __( 'To be the most trusted remodeling partner in every neighborhood we serve, known as much for our craftsmanship as for how we treat people along the way.', 'elite-remodel-hub' ),

		// ------ About page - Stats. ------
		'stats_items' => array(
			array( 'value' => '18+', 'label' => __( 'Years in Business', 'elite-remodel-hub' ) ),
			array( 'value' => '640+', 'label' => __( 'Projects Completed', 'elite-remodel-hub' ) ),
			array( 'value' => '98%', 'label' => __( 'Client Satisfaction', 'elite-remodel-hub' ) ),
			array( 'value' => '32', 'label' => __( 'Skilled Team Members', 'elite-remodel-hub' ) ),
		),

		// ------ About page - Values. ------
		'values_eyebrow'         => __( 'Our Values', 'elite-remodel-hub' ),
		'values_title'           => __( 'What Drives Us Forward', 'elite-remodel-hub' ),
		'values_title_highlight' => 2,
		'values_text'            => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum non convallis nisi, convallis massa.', 'elite-remodel-hub' ),
		'values_items'           => array(
			array(
				'icon'  => 'shield',
				'title' => __( 'Honesty First', 'elite-remodel-hub' ),
				'text'  => __( 'Transparent pricing and straight answers, even when the news is inconvenient.', 'elite-remodel-hub' ),
			),
			array(
				'icon'  => 'hammer',
				'title' => __( 'Real Craftsmanship', 'elite-remodel-hub' ),
				'text'  => __( 'Every cut, joint and finish held to a standard we would want in our own homes.', 'elite-remodel-hub' ),
			),
			array(
				'icon'  => 'clock',
				'title' => __( 'Respect for Time', 'elite-remodel-hub' ),
				'text'  => __( 'Realistic timelines, clear updates, and crews who show up when they say they will.', 'elite-remodel-hub' ),
			),
			array(
				'icon'  => 'sparkles',
				'title' => __( 'Lasting Care', 'elite-remodel-hub' ),
				'text'  => __( 'Our relationship does not end at handover - we stand behind our work long after.', 'elite-remodel-hub' ),
			),
		),

		// ------ About page - Team. ------
		'team_eyebrow'         => __( 'Our Team', 'elite-remodel-hub' ),
		'team_title'           => __( 'Meet the Experts', 'elite-remodel-hub' ),
		'team_title_highlight' => 1,
		'team_text'            => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum non convallis nisi, convallis massa.', 'elite-remodel-hub' ),
		'team_members'         => array(
			array( 'photo' => array( 'url' => $placeholder, 'alt' => '' ), 'name' => 'Arman Yusuf', 'role' => __( 'Founder & Lead Contractor', 'elite-remodel-hub' ) ),
			array( 'photo' => array( 'url' => $placeholder, 'alt' => '' ), 'name' => 'Rina Halim', 'role' => __( 'Principal Designer', 'elite-remodel-hub' ) ),
			array( 'photo' => array( 'url' => $placeholder, 'alt' => '' ), 'name' => 'Doni Saputra', 'role' => __( 'Project Manager', 'elite-remodel-hub' ) ),
			array( 'photo' => array( 'url' => $placeholder, 'alt' => '' ), 'name' => 'Lina Wijaya', 'role' => __( 'Client Relations', 'elite-remodel-hub' ) ),
		),

		// ------ Contact page - Banner. ------
		'contact_banner_eyebrow'         => __( 'Contact Us', 'elite-remodel-hub' ),
		'contact_banner_title'           => __( "Let's Start Your Renovation", 'elite-remodel-hub' ),
		'contact_banner_title_highlight' => 2,
		'contact_banner_text'            => __( 'Tell us about your project and we will get back to you within one business day with next steps and a free consultation.', 'elite-remodel-hub' ),

		// ------ Contact page - Info & Form. ------
		'contact_form_eyebrow'         => __( 'Get In Touch', 'elite-remodel-hub' ),
		'contact_form_title'           => __( 'Send Us a Message', 'elite-remodel-hub' ),
		'contact_form_title_highlight' => 1,
		'contact_form_text'            => __( 'Fill out the form and a member of our team will follow up shortly.', 'elite-remodel-hub' ),

		// ------ FAQ page - Banner and questions. ------
		'faq_banner_eyebrow'          => __( 'Frequently Asked Questions', 'elite-remodel-hub' ),
		'faq_banner_title'            => __( 'Answers For Your Remodeling Journey', 'elite-remodel-hub' ),
		'faq_banner_title_highlight'  => 2,
		'faq_banner_text'             => __( 'From the first conversation to the final walkthrough, here is what you can expect when you work with Elite Remodel Hub.', 'elite-remodel-hub' ),
		'faq_content_eyebrow'         => __( 'Good To Know', 'elite-remodel-hub' ),
		'faq_content_title'           => __( 'Questions, Answered Clearly', 'elite-remodel-hub' ),
		'faq_content_title_highlight' => 1,
		'faq_content_text'            => __( 'We believe a well-informed client is a confident client. Browse the answers below, or contact our team if you need advice for your specific project.', 'elite-remodel-hub' ),
		'faq_items'                   => array(
			array(
				'question' => __( 'How do I get started with a remodeling project?', 'elite-remodel-hub' ),
				'answer'   => __( 'Start with a free consultation. We will listen to your goals, review the space, discuss your budget and outline the next practical steps for your project.', 'elite-remodel-hub' ),
			),
			array(
				'question' => __( 'How long does a typical renovation take?', 'elite-remodel-hub' ),
				'answer'   => __( 'The timeline depends on the size and complexity of the work. After the design and scope are approved, your project manager will provide a clear schedule and keep you updated throughout.', 'elite-remodel-hub' ),
			),
			array(
				'question' => __( 'Can you help with design as well as construction?', 'elite-remodel-hub' ),
				'answer'   => __( 'Yes. Our designers and craftsmen work together from the first sketch through the final installation, so the finished space is both beautiful and practical.', 'elite-remodel-hub' ),
			),
			array(
				'question' => __( 'Do you provide a detailed estimate before work begins?', 'elite-remodel-hub' ),
				'answer'   => __( 'Yes. We explain the recommended scope, materials, allowances and expected costs before you approve the project. Any changes are discussed with you before they are made.', 'elite-remodel-hub' ),
			),
			array(
				'question' => __( 'Are you licensed and insured?', 'elite-remodel-hub' ),
				'answer'   => __( 'Our team works with the required licenses and insurance for the services we provide. We are happy to share project-specific documentation during the consultation.', 'elite-remodel-hub' ),
			),
		),

		// ------ Privacy Policy page. ------
		'privacy_banner_eyebrow'         => __( 'Your Privacy Matters', 'elite-remodel-hub' ),
		'privacy_banner_title'           => __( 'Privacy Policy', 'elite-remodel-hub' ),
		'privacy_banner_title_highlight' => 1,
		'privacy_banner_text'            => __( 'What we collect when you contact us or use this website, why we use it, and the choices available to you.', 'elite-remodel-hub' ),
		'privacy_last_updated'           => __( 'August 27, 2026', 'elite-remodel-hub' ),
		'privacy_version'                => '1.0',
		'privacy_intro'                  => __( 'Elite Remodel Hub provides remodeling design, planning and construction services for homeowners. To respond to inquiries, prepare estimates and deliver our services, we may need to collect limited information about you. This Privacy Policy explains what we collect, how we use it, when we share it and how you can contact us about your information. We do not sell personal information or add your details to third-party marketing lists.', 'elite-remodel-hub' ),
		'privacy_sections'               => array(
			array( 'title' => __( 'Who We Are', 'elite-remodel-hub' ), 'body' => __( 'For purposes of this Privacy Policy, "Elite Remodel Hub," "we," "our" and "us" refer to the remodeling business operating this website. We help homeowners plan and complete thoughtful renovations, including kitchens, bathrooms, living spaces and whole-home projects.', 'elite-remodel-hub' ) ),
			array( 'title' => __( 'What We Collect', 'elite-remodel-hub' ), 'body' => __( 'When you contact us, request a consultation or ask about our services, you may provide your name, email address, phone number, property address, project details, budget information and any other information you choose to include. We may also automatically receive technical information such as your IP address, browser, device, pages visited, referring website and general usage data.', 'elite-remodel-hub' ) ),
			array( 'title' => __( 'Why We Collect It', 'elite-remodel-hub' ), 'body' => __( 'We use information to respond to questions, schedule consultations, prepare estimates, plan and manage remodeling work, provide customer support, communicate about projects, improve our website and protect the security of our services. Where permitted by law, we may send service updates or relevant marketing communications. You can opt out of marketing messages at any time using the unsubscribe instructions or by contacting us.', 'elite-remodel-hub' ) ),
			array( 'title' => __( 'Cookies and Analytics', 'elite-remodel-hub' ), 'body' => __( 'This website may use cookies and similar technologies to keep the site working, remember preferences, understand traffic and improve performance. Analytics providers may receive aggregated information about pages visited, device type, browser and general usage. You can manage cookies through your browser settings, although disabling them may affect some website features.', 'elite-remodel-hub' ) ),
			array( 'title' => __( 'Who We Share It With', 'elite-remodel-hub' ), 'body' => __( 'We may share information with trusted hosting, communications, scheduling, payment, analytics and other technology providers, contractors or business partners when reasonably necessary to operate the website, respond to you or provide requested services. We may also disclose information when required by law or when necessary to protect our rights, customers, property or security. We do not sell or rent personal information.', 'elite-remodel-hub' ) ),
			array( 'title' => __( 'How Long We Keep It', 'elite-remodel-hub' ), 'body' => __( 'We retain personal information only for as long as reasonably necessary for the purposes described in this policy, including customer service, project records, accounting, legal obligations, dispute resolution and security. When it is no longer needed, we may delete, anonymize or securely dispose of it in accordance with applicable requirements.', 'elite-remodel-hub' ) ),
			array( 'title' => __( 'How We Protect It', 'elite-remodel-hub' ), 'body' => __( 'We use reasonable administrative, technical and organizational safeguards designed to protect personal information from unauthorized access, misuse, loss, alteration or disclosure. No method of transmitting or storing information online is completely secure, so we cannot guarantee absolute security.', 'elite-remodel-hub' ) ),
			array( 'title' => __( 'Your Choices and Rights', 'elite-remodel-hub' ), 'body' => __( 'Depending on where you live and applicable law, you may be able to request access to, correction of, deletion of or a copy of your personal information, or opt out of certain communications. We may need to verify your identity before completing a request. We will not discriminate against you for exercising rights available under applicable law.', 'elite-remodel-hub' ) ),
			array( 'title' => __( 'Changes to This Policy', 'elite-remodel-hub' ), 'body' => __( 'We may update this Privacy Policy as our practices, services or legal obligations change. The updated version will be posted on this page with a revised last-updated date. We encourage you to review this page periodically.', 'elite-remodel-hub' ) ),
		),
		'privacy_request_eyebrow'         => __( 'Making a Request', 'elite-remodel-hub' ),
		'privacy_request_title'           => __( 'Questions About Your Information?', 'elite-remodel-hub' ),
		'privacy_request_text'            => __( 'Email us with enough detail to identify your request. We may ask for information to verify your identity, and we will respond within the period required by applicable law.', 'elite-remodel-hub' ),
		'privacy_request_email'           => 'info@eliteremodelhub.com',
		'privacy_request_address'         => "",
		'privacy_state_notice'            => __( 'If you reside in California, Oregon, Florida or Washington, additional privacy rights may apply under state law. Depending on the law applicable to your request, those rights may include access to information about our collection and use of personal information, correction, deletion, a copy of your information, or the ability to opt out of certain processing or marketing. Contact us using the details above to make a request. We will verify and respond as required by applicable law. This notice is intended as general information and does not limit any rights provided by the laws of your state.', 'elite-remodel-hub' ),

		// ------ Service Listing page - Banner and grid. ------
		'service_listing_banner_eyebrow'         => __( 'Our Services', 'elite-remodel-hub' ),
		'service_listing_banner_title'           => __( 'Remodeling Services Built Around You', 'elite-remodel-hub' ),
		'service_listing_banner_title_highlight' => 2,
		'service_listing_banner_text'            => __( 'From single-room refreshes to whole-home renovations, explore every service our design and construction team delivers.', 'elite-remodel-hub' ),
		'service_listing_per_page'               => 9,

		// ------ Service detail page (single-service.php). ------
		'service_tagline'         => __( 'Thoughtful design and expert craftsmanship, start to finish.', 'elite-remodel-hub' ),
		'service_hero_image'      => array( 'url' => $placeholder, 'alt' => '' ),
		'service_facts'           => array(
			array( 'icon' => 'clock', 'label' => __( 'Typical Timeline', 'elite-remodel-hub' ), 'value' => __( '4-8 Weeks', 'elite-remodel-hub' ) ),
			array( 'icon' => 'award', 'label' => __( 'Investment Range', 'elite-remodel-hub' ), 'value' => __( 'Custom Quote', 'elite-remodel-hub' ) ),
			array( 'icon' => 'shield', 'label' => __( 'Warranty', 'elite-remodel-hub' ), 'value' => __( '2-Year Workmanship', 'elite-remodel-hub' ) ),
		),
		'service_features_title'  => __( "What's Included", 'elite-remodel-hub' ),
		'service_features_items'  => array(
			array( 'icon' => 'chat', 'title' => __( 'Free In-Home Consultation', 'elite-remodel-hub' ), 'text' => __( 'We walk the space with you and talk through goals, style and budget before anything is designed.', 'elite-remodel-hub' ) ),
			array( 'icon' => 'ruler', 'title' => __( 'Custom Design Plan', 'elite-remodel-hub' ), 'text' => __( 'A detailed plan and material selection tailored to your home, not a one-size-fits-all package.', 'elite-remodel-hub' ) ),
			array( 'icon' => 'shield', 'title' => __( 'Licensed &amp; Insured Crew', 'elite-remodel-hub' ), 'text' => __( 'Every project is completed by our own vetted, insured tradespeople - never unsupervised subcontractors.', 'elite-remodel-hub' ) ),
			array( 'icon' => 'users', 'title' => __( 'Dedicated Project Manager', 'elite-remodel-hub' ), 'text' => __( 'One point of contact keeps the schedule, budget and communication on track from start to finish.', 'elite-remodel-hub' ) ),
		),
		'service_process_title'   => __( 'Our Process', 'elite-remodel-hub' ),
		'service_process_steps'   => array(
			array( 'title' => __( 'Free Consultation', 'elite-remodel-hub' ), 'text' => __( 'We visit your home, listen to your goals and discuss budget and timeline.', 'elite-remodel-hub' ) ),
			array( 'title' => __( 'Design &amp; Estimate', 'elite-remodel-hub' ), 'text' => __( 'You receive a detailed design, material selections and a transparent estimate.', 'elite-remodel-hub' ) ),
			array( 'title' => __( 'Construction', 'elite-remodel-hub' ), 'text' => __( 'Our crew gets to work, with regular updates so you always know what to expect.', 'elite-remodel-hub' ) ),
			array( 'title' => __( 'Final Walkthrough', 'elite-remodel-hub' ), 'text' => __( 'We review every detail together and make sure the finished space is exactly right.', 'elite-remodel-hub' ) ),
		),
		'service_gallery'         => array(),
		'service_cta_title'       => '',
		'service_cta_text'        => __( 'Tell us about your project and we will get back to you within one business day with next steps and a free consultation.', 'elite-remodel-hub' ),
		'service_cta_button'      => array( 'url' => '#contact', 'title' => __( 'Get a Free Quote', 'elite-remodel-hub' ), 'target' => '' ),

		// ------ Location page (page-location.php). ------
		'location_name'                    => __( 'Your Area', 'elite-remodel-hub' ),
		'location_hero_title'              => '',
		'location_hero_title_highlight'    => 2,
		'location_hero_text'               => __( 'Local design, licensed crews and craftsmanship that lasts - from the first consultation to the final walkthrough.', 'elite-remodel-hub' ),
		'location_hero_image'              => array( 'url' => $placeholder, 'alt' => '' ),
		'location_badges'                  => array(
			array( 'icon' => 'shield', 'text' => __( 'Licensed &amp; Insured', 'elite-remodel-hub' ) ),
			array( 'icon' => 'star', 'text' => __( '4.9 Average Rating', 'elite-remodel-hub' ) ),
			array( 'icon' => 'award', 'text' => __( 'Free In-Home Estimates', 'elite-remodel-hub' ) ),
		),
		'location_overview_eyebrow'        => __( 'Local &amp; Trusted', 'elite-remodel-hub' ),
		'location_overview_title'          => '',
		'location_overview_title_highlight' => 2,
		'location_overview_text'           => __( 'We are a local, licensed remodeling team, not a call center dispatching subcontractors. When you reach out, you are talking to the people who will actually plan and build your project.', 'elite-remodel-hub' ),
		'location_overview_text_2'         => __( 'From the first walkthrough to the final coat of paint, we keep you informed at every step, so there are no surprises along the way.', 'elite-remodel-hub' ),
		'location_overview_points'         => array(
			array( 'text' => __( 'Locally owned and operated', 'elite-remodel-hub' ) ),
			array( 'text' => __( 'Licensed, bonded &amp; insured', 'elite-remodel-hub' ) ),
			array( 'text' => __( 'Free, no-obligation estimates', 'elite-remodel-hub' ) ),
			array( 'text' => __( 'Transparent, itemized pricing', 'elite-remodel-hub' ) ),
		),
		'location_form_title'              => '',
		'location_form_text'               => __( 'Fast response. No spam. No obligation.', 'elite-remodel-hub' ),
		'location_stats_items'             => array(
			array( 'value' => '15+', 'label' => __( 'Years Serving the Area', 'elite-remodel-hub' ) ),
			array( 'value' => '500+', 'label' => __( 'Projects Completed', 'elite-remodel-hub' ) ),
			array( 'value' => '4.9', 'label' => __( 'Average Star Rating', 'elite-remodel-hub' ) ),
		),
		'location_services_title'          => '',
		'location_services_title_highlight' => 1,
		'location_services_text'           => __( 'From single-room refreshes to whole-home renovations, our local crews handle every stage of your project.', 'elite-remodel-hub' ),
		'location_insights_title'          => '',
		'location_insights_text'           => __( 'Every neighborhood remodels a little differently. Here is what we keep in mind when we work in your area.', 'elite-remodel-hub' ),
		'location_insights_items'          => array(
			array( 'icon' => 'home', 'title' => __( 'Local Housing Stock', 'elite-remodel-hub' ), 'text' => __( 'We know the quirks of older homes in the area - from outdated wiring to layouts that no longer fit modern life.', 'elite-remodel-hub' ) ),
			array( 'icon' => 'calendar-check', 'title' => __( 'Permits &amp; Local Codes', 'elite-remodel-hub' ), 'text' => __( 'We handle permitting and inspections with the local building department, so nothing holds up your project.', 'elite-remodel-hub' ) ),
			array( 'icon' => 'sparkles', 'title' => __( 'Climate-Ready Materials', 'elite-remodel-hub' ), 'text' => __( 'Material choices selected to hold up to the local climate, not just look good on installation day.', 'elite-remodel-hub' ) ),
			array( 'icon' => 'users', 'title' => __( 'Neighborhood Style', 'elite-remodel-hub' ), 'text' => __( 'Designs that fit the character of the neighborhood while still feeling like your own home.', 'elite-remodel-hub' ) ),
		),
		'location_gallery_title'           => '',
		'location_gallery'                 => array(),
		'location_areas_title'             => '',
		'location_areas_text'              => __( 'Based locally and proud to serve homeowners throughout the surrounding area.', 'elite-remodel-hub' ),
		'location_areas_list'              => array(),
		'location_cta_title'               => '',
		'location_cta_text'                => __( 'Tell us about your project and we will get back to you within one business day with next steps and a free consultation.', 'elite-remodel-hub' ),
		'location_cta_button'              => array( 'url' => '', 'title' => __( 'Get a Free Quote', 'elite-remodel-hub' ), 'target' => '' ),
		'location_cta_bg_image'            => array( 'url' => $placeholder, 'alt' => '' ),

		// ------ Blog listing page (home.php). ------
		'blog_banner_eyebrow'         => __( 'Our Blog', 'elite-remodel-hub' ),
		'blog_banner_title'           => __( 'Insights, Ideas &amp; Inspiration', 'elite-remodel-hub' ),
		'blog_banner_title_highlight' => 2,
		'blog_banner_text'            => __( 'Practical advice, design inspiration and behind-the-scenes stories from our remodeling projects.', 'elite-remodel-hub' ),
	);

	return $defaults;
}

/**
 * Look up a single default by field name.
 *
 * @param string $selector Field name.
 * @return mixed Null when there is no default registered for that field.
 */
function erh_default( $selector ) {
	$defaults = erh_defaults();

	return isset( $defaults[ $selector ] ) ? $defaults[ $selector ] : null;
}
