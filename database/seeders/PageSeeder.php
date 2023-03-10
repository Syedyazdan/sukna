<?php

namespace Database\Seeders;

use Botble\Base\Models\MetaBox as MetaBoxModel;
use Botble\Base\Supports\BaseSeeder;
use Botble\Language\Models\LanguageMeta;
use Botble\Page\Models\Page;
use Botble\LanguageAdvanced\Models\PageTranslation;
use Botble\Slug\Models\Slug;
use Html;
use Illuminate\Support\Str;
use SlugHelper;

class PageSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->uploadFiles('banners');

        $pages = [
            [
                'name'     => 'Home',
                'content'  =>
                    Html::tag(
                        'div',
                        '[hero-banner title="Find accessible homes to rent" bg="banners/banner-1.jpg"][/hero-banner]'
                    ) .
                    Html::tag('div', '[static-block alias="how-it-works"][/static-block]') .
                    Html::tag(
                        'div',
                        '[featured-properties title="Explore Good Places" limit="6" style="2" type="2"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/featured-properties]'
                    ) .
                    Html::tag(
                        'div',
                        '[properties-by-locations title="Find By Locations"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/properties-by-locations]'
                    ) .
                    Html::tag(
                        'div',
                        '[testimonials title="Good Reviews By Customers" description="At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores"][/testimonials]'
                    ) .
                    Html::tag(
                        'div',
                        '[our-packages title="See Our Packages" description="At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores"][/our-packages]'
                    ) .
                    Html::tag(
                        'div',
                        '[recently-viewed-properties title="Recently Viewed Properties" subtitle="Your currently viewed properties."][/recently-viewed-properties]'
                    )
                ,
                'template' => 'homepage',
            ],
            [
                'name'     => 'Home layout 2',
                'content'  =>
                    Html::tag(
                        'div',
                        '[hero-banner title="Find accessible homes to rent" bg="banners/banner-svg.jpg" style="2"]Find Your Perfect Place.[/hero-banner]'
                    ) .
                    Html::tag('div', '[static-block alias="achievement"][/static-block]') .
                    Html::tag(
                        'div',
                        '[properties-slide title="Recent Property For Rent" limit="6"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/properties-slide]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-properties title="Featured Property For Sale" limit="6" style="1" type="2"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/featured-properties]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-agents title="Explore Featured Agents"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/featured-agents]'
                    ) .
                    Html::tag(
                        'div',
                        '[testimonials title="Good Reviews By Customers" description="At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores"][/testimonials]'
                    ) .
                    Html::tag(
                        'div',
                        '[our-packages title="See Our Packages" description="At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores"][/our-packages]'
                    ) .
                    Html::tag('div', '[static-block alias="download-app"][/static-block]')
                ,
                'template' => 'homepage',
            ],
            [
                'name'     => 'Home layout 3',
                'content'  =>
                    Html::tag(
                        'div',
                        '[hero-banner title="Find Your Property" bg="banners/banner-3.jpg" style="3" overlay="6"]From as low as $10 per day with limited time offer[/hero-banner]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-properties title="Explore Good Places" limit="6" style="2" type="2"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/featured-properties]'
                    ) .
                    Html::tag(
                        'div',
                        '[properties-by-locations title="Find By Locations"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/properties-by-locations]'
                    ) .
                    Html::tag('div', '[static-block alias="how-it-works"][/static-block]') .
                    Html::tag(
                        'div',
                        '[testimonials title="Good Reviews By Customers" description="At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores"][/testimonials]'
                    ) .
                    Html::tag(
                        'div',
                        '[our-packages title="See Our Packages" description="At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores"][/our-packages]'
                    ) .
                    Html::tag(
                        'div',
                        '[cover-banner title="Search Perfect Place In Your City" bg="banners/banner-2.jpg" btntext="Explore More Property" btnlink="#"]We post regulary most powerful articles for help and support.[/cover-banner]'
                    ) .
                    Html::tag(
                        'div',
                        '[latest-news title="News By Resido,3"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/latest-news]'
                    )
                ,
                'template' => 'homepage',
            ],
            [
                'name'     => 'Home layout 4',
                'content'  =>
                    Html::tag(
                        'div',
                        '[hero-banner title="Find Your Place<br>of Dream" bg="banners/banner-6.png" style="4"]Amet consectetur adipisicing <span class="badge badge-success">New</span>[/hero-banner]'
                    ) .
                    Html::tag('div', '[static-block alias="achievement"][/static-block]') .
                    Html::tag(
                        'div',
                        '[properties-slide title="Recent Property For Rent" limit="6" style="1"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/properties-slide]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-properties title="Explore Good Places" limit="6" type="2"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/featured-properties]'
                    ) .
                    Html::tag('div', '[static-block alias="how-it-works"][/static-block]') .
                    Html::tag(
                        'div',
                        '[testimonials title="Good Reviews By Customers" description="At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores"][/testimonials]'
                    ) .
                    Html::tag(
                        'div',
                        '[our-packages title="See Our Packages" description="At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores"][/our-packages]'
                    ) .
                    Html::tag('div', '[static-block alias="download-app"][/static-block]')
                ,
                'template' => 'homepage',
            ],
            [
                'name'     => 'Home layout 5',
                'content'  =>
                    Html::tag(
                        'div',
                        '[hero-banner title="Find Your Perfect Place." bg="banners/home-2.png" style="5"]Amet consectetur adipisicing New[/hero-banner]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-properties title="Explore Good Places" limit="6" style="2" type="2"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/featured-properties]'
                    ) .
                    Html::tag(
                        'div',
                        '[properties-by-locations title="Find By Locations"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/properties-by-locations]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-properties title="Explore Good Places" limit="6" style="1" type="1"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/featured-properties]'
                    ) .
                    Html::tag(
                        'div',
                        '[testimonials title="Good Reviews By Customers" description="At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores"][/testimonials]'
                    ) .
                    Html::tag(
                        'div',
                        '[our-packages title="See Our Packages" description="At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores"][/our-packages]'
                    ) .
                    Html::tag(
                        'div',
                        '[static-block alias="download-app"][/static-block]'
                    )
                ,
                'template' => 'homepage',
            ],
            [
                'name'     => 'Home layout 6',
                'content'  =>
                    Html::tag(
                        'div',
                        '[hero-banner title="Amet consectetur adipisicing" bg="banners/banner-6.png" style="6"]Find Your Place <br>Of Dream[/hero-banner]'
                    ) .
                    Html::tag('div', '[static-block alias="achievement"][/static-block]') .
                    Html::tag(
                        'div',
                        '[properties-slide title="Recent Property For Rent" limit="6" style="1"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/properties-slide]'
                    ) .
                    Html::tag(
                        'div',
                        '[properties-by-locations title="Find By Locations"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/properties-by-locations]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-properties title="Explore Good Places" limit="8" style="1" type="2"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/featured-properties]'
                    ) .
                    Html::tag('div', '[static-block alias="how-it-works"][/static-block]') .
                    Html::tag(
                        'div',
                        '[testimonials title="Good Reviews By Customers" description="At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores"][/testimonials]'
                    ) .
                    Html::tag(
                        'div',
                        '[our-packages title="See Our Packages" description="At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores"][/our-packages]'
                    ) .
                    Html::tag(
                        'div',
                        '[static-block alias="download-app"][/static-block]'
                    )
                ,
                'template' => 'homepage',
            ],
            [
                'name'     => 'Home layout 7',
                'content'  =>
                    Html::tag(
                        'div',
                        '[hero-banner title="Find accessible homes to rent" bg="banners/banner-1.jpg"]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-properties title="Explore Good Places" limit="6" style="1" type="2"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/featured-properties]'
                    ) .
                    Html::tag(
                        'div',
                        '[properties-by-locations title="Find By Locations"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/properties-by-locations]'
                    ) .
                    Html::tag('div', '[static-block alias="how-it-works"][/static-block]') .
                    Html::tag(
                        'div',
                        '[cover-banner title="Search Perfect Place In Your City" bg="banners/banner-2.jpg" btntext="Explore More Property" btnlink="#"]We post regulary most powerful articles for help and support.[/cover-banner]'
                    ) .
                    Html::tag(
                        'div',
                        '[latest-news title="News By Resido,3"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/latest-news]'
                    )
                ,
                'template' => 'homepage',
            ],
            [
                'name'     => 'Home layout 8',
                'content'  =>
                    Html::tag('div', '[properties-hero-slide limit="6"][/properties-hero-slide]') .
                    Html::tag('div', '[static-block alias="how-it-works"][/static-block]') .
                    Html::tag(
                        'div',
                        '[featured-properties title="Explore Good Places" limit="6" style="2" type="2"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/featured-properties]'
                    ) .
                    Html::tag(
                        'div',
                        '[properties-by-locations title="Find By Locations"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/properties-by-locations]'
                    ) .
                    Html::tag(
                        'div',
                        '[testimonials title="Good Reviews By Customers" description="At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores"][/testimonials]'
                    ) .
                    Html::tag(
                        'div',
                        '[our-packages title="See Our Packages" description="At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores"][/our-packages]'
                    )
                ,
                'template' => 'homepage',
            ],
            [
                'name'     => 'Home layout 9',
                'content'  =>
                    Html::tag(
                        'div',
                        '[hero-banner title="Find accessible homes to rent" bg="banners/new-banner.jpg" style="2"]Find Your Perfect Place.[/hero-banner]'
                    ) .
                    Html::tag('div', '[static-block alias="achievement"][/static-block]') .
                    Html::tag(
                        'div',
                        '[properties-slide title="Recent Property For Rent" limit="6"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/properties-slide]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-properties title="Explore Good Places" limit="6" type="2"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/featured-properties]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-agents title="Explore Featured Agents"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/featured-agents]'
                    ) .
                    Html::tag(
                        'div',
                        '[testimonials title="Good Reviews By Customers" description="At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores"][/testimonials]'
                    ) .
                    Html::tag(
                        'div',
                        '[our-packages title="See Our Packages" description="At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores"][/our-packages]'
                    ) .
                    Html::tag('div', '[static-block alias="download-app"][/static-block]')
                ,
                'template' => 'homepage',
            ],
            [
                'name'     => 'Map Home layout',
                'content'  =>
                    Html::tag('div') .
                    Html::tag('div', '[static-block alias="achievement"][/static-block]') .
                    Html::tag(
                        'div',
                        '[properties-slide title="Recent Property For Rent" limit="6"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/properties-slide]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-properties title="Explore Good Places" limit="6" type="2"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/featured-properties]'
                    ) .
                    Html::tag('div', '[static-block alias="how-it-works"][/static-block]') .
                    Html::tag(
                        'div',
                        '[testimonials title="Good Reviews By Customers" description="At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores"][/testimonials]'
                    ) .
                    Html::tag(
                        'div',
                        '[our-packages title="See Our Packages" description="At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores"][/our-packages]'
                    ) .
                    Html::tag('div', '[static-block alias="download-app"][/static-block]')
                ,
                'template' => 'homepage',
            ],
            [
                'name'     => 'Properties',
                'content'  => '---',
                'template' => 'default',
            ],
            [
                'name'        => 'News',
                'description' => 'See Our Latest Articles & News',
                'content'     => ' ',
                'template'    => 'default',
            ],
            [
                'name'        => 'About us',
                'description' => 'Who we are & our mission',
                'content'     => Html::tag('div', '[static-block alias="our-story"][/static-block]') .
                        Html::tag('div', '[static-block alias="our-mission"][/static-block]')
                ,
                'template'    => 'default',
            ],
            [
                'name'     => 'Contact',
                'content'  => '<p>[contact-form][/contact-form]<br />
                            &nbsp;</p>

                            <h3>Directions</h3>

                            <p>[google-map]North Link Building, 10 Admiralty Street, 757695 Singapore[/google-map]</p>

                            <p>&nbsp;</p>',
                'template' => 'default',
            ],
            [
                'name'        => 'Terms & Conditions',
                'description' => 'Copyrights and other intellectual property rights to all text, images, audio, software and other content on this site are owned by Resido and its affiliates. Users are allowed to view the contents of the website, cite the contents by printing, downloading the hard disk and distributing it to others for non-commercial purposes.',
                'content'     => '<p style="text-align: justify;"><span style="font-size:16px;"><span style="font-family:Arial,Helvetica,sans-serif;">Access to and use of the Resido website is subject to the following terms, conditions, and relevant laws of Vietnam.</span></span></p>

                    <h4 style="text-align: justify;"><span style="font-size:18px;"><span style="font-family:Arial,Helvetica,sans-serif;"><strong>1. Copyright</strong></span></span></h4>

                    <p style="text-align: justify;"><span style="font-size:16px;"><span style="font-family:Arial,Helvetica,sans-serif;">Copyrights and other intellectual property rights to all text, images, audio, software and other content on this site are owned by Resido and its affiliates. Users are allowed to view the contents of the website, cite the contents by printing, downloading the hard disk and distributing it to others for non-commercial purposes, providing information or personal purposes. </span></span><span style="font-size:16px;"><span style="font-family:Arial,Helvetica,sans-serif;">Any content from this site may not be used for sale or distribution for profit, nor may it be edited or included in any other publication or website.</span></span></p>

                    <h4 style="text-align: justify;"><span style="font-size:18px;"><span style="font-family:Arial,Helvetica,sans-serif;"><strong>2. Content</strong></span></span></h4>

                    <p style="text-align: justify;"><span style="font-size:16px;"><span style="font-family:Arial,Helvetica,sans-serif;">The information on this website is compiled with great confidence but for general information research purposes only. While we endeavor to maintain updated and accurate information, we make no representations or warranties in any manner regarding completeness, accuracy, reliability, appropriateness or availability in relation to web site, or related information, product, service, or image within the website for any purpose. </span></span></p>

                        <p style="text-align: justify;"><span style="font-size:16px;"><span style="font-family:Arial,Helvetica,sans-serif;">Resido and its employees, managers, and agents are not responsible for any loss, damage or expense incurred as a result of accessing and using this website and the sites. </span></span><span style="font-size:16px;"><span style="font-family:Arial,Helvetica,sans-serif;">The web is connected to it, including but not limited to, loss of profits, direct or indirect losses. We are also not responsible, or jointly responsible, if the site is temporarily inaccessible due to technical issues beyond our control. Any comments, suggestions, images, ideas and other information or materials that users submit to us through this site will become our exclusive property, including the right to may arise in the future associated with us.</span></span></p>

                    <p style="text-align: center;"><span style="font-size:16px;"><span style="font-family:Arial,Helvetica,sans-serif;"><img alt="" src="https://flex-home.botble.com/storage/general/copyright.jpg" style="width: 90%;" /></span></span></p>

                    <h4 style="text-align: justify;"><span style="font-size:18px;"><span style="font-family:Arial,Helvetica,sans-serif;"><strong>3. Note on&nbsp;connected sites</strong></span></span></h4>

                    <p style="text-align: justify;"><span style="font-size:16px;"><span style="font-family:Arial,Helvetica,sans-serif;">At many points in the website, users can get links to other websites related to a specific aspect. This does not mean that we are related to the websites or companies that own these websites. Although we intend to connect users to sites of interest, we are not responsible or jointly responsible for our employees, managers, or representatives. with other websites and information contained therein.</span></span></p>
                ',
                'template'    => 'default',
            ],
            [
                'name'     => 'Cookie Policy',
                'content'  => Html::tag('h3', 'EU Cookie Consent') .
                    Html::tag(
                        'p',
                        'To use this website we are using Cookies and collecting some Data. To be compliant with the EU GDPR we give you to choose if you allow us to use certain Cookies and to collect some Data.'
                    ) .
                    Html::tag('h4', 'Essential Data') .
                    Html::tag(
                        'p',
                        'The Essential Data is needed to run the Site you are visiting technically. You can not deactivate them.'
                    ) .
                    Html::tag(
                        'p',
                        '- Session Cookie: PHP uses a Cookie to identify user sessions. Without this Cookie the Website is not working.'
                    ) .
                    Html::tag(
                        'p',
                        '- XSRF-Token Cookie: Laravel automatically generates a CSRF "token" for each active user session managed by the application. This token is used to verify that the authenticated user is the one actually making the requests to the application.'
                    ),
                'template' => 'default',
            ],
        ];
        $translations = [
            [
                'name'     => 'Trang ch???',
                'content'  =>
                    Html::tag(
                        'div',
                        '[hero-banner title="Find accessible homes to rent" bg="banners/banner-1.jpg"][/hero-banner]'
                    ) .
                    Html::tag('div', '[static-block alias="how-it-works"][/static-block]') .
                    Html::tag(
                        'div',
                        '[featured-properties title="Explore Good Places" limit="6" style="2" type="2"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/featured-properties]'
                    ) .
                    Html::tag(
                        'div',
                        '[properties-by-locations title="Find By Locations"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/properties-by-locations]'
                    ) .
                    Html::tag(
                        'div',
                        '[testimonials title="Good Reviews By Customers" description="At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores"][/testimonials]'
                    ) .
                    Html::tag(
                        'div',
                        '[our-packages title="See Our Packages" description="At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores"][/our-packages]'
                    ) .
                    Html::tag(
                        'div',
                        '[recently-viewed-properties title="Recently Viewed Properties" subtitle="Your currently viewed properties."][/recently-viewed-properties]'
                    )
                ,
            ],
            [
                'name'     => 'Trang ch??? 2',
                'content'  =>
                    Html::tag(
                        'div',
                        '[hero-banner title="Find accessible homes to rent" bg="banners/banner-svg.jpg" style="2"]Find Your Perfect Place.[/hero-banner]'
                    ) .
                    Html::tag('div', '[static-block alias="achievement"][/static-block]') .
                    Html::tag(
                        'div',
                        '[properties-slide title="Recent Property For Rent" limit="6"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/properties-slide]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-properties title="Featured Property For Sale" limit="6" style="1" type="2"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/featured-properties]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-agents title="Explore Featured Agents"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/featured-agents]'
                    ) .
                    Html::tag(
                        'div',
                        '[testimonials title="Good Reviews By Customers" description="At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores"][/testimonials]'
                    ) .
                    Html::tag(
                        'div',
                        '[our-packages title="See Our Packages" description="At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores"][/our-packages]'
                    ) .
                    Html::tag('div', '[static-block alias="download-app"][/static-block]')
                ,
            ],
            [
                'name'     => 'Trang ch??? 3',
                'content'  =>
                    Html::tag(
                        'div',
                        '[hero-banner title="Find Your Property" bg="banners/banner-3.jpg" style="3" overlay="6"]From as low as $10 per day with limited time offer[/hero-banner]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-properties title="Explore Good Places" limit="6" style="2" type="2"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/featured-properties]'
                    ) .
                    Html::tag(
                        'div',
                        '[properties-by-locations title="Find By Locations"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/properties-by-locations]'
                    ) .
                    Html::tag('div', '[static-block alias="how-it-works"][/static-block]') .
                    Html::tag(
                        'div',
                        '[testimonials title="Good Reviews By Customers" description="At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores"][/testimonials]'
                    ) .
                    Html::tag(
                        'div',
                        '[our-packages title="See Our Packages" description="At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores"][/our-packages]'
                    ) .
                    Html::tag(
                        'div',
                        '[cover-banner title="Search Perfect Place In Your City" bg="banners/banner-2.jpg" btntext="Explore More Property" btnlink="#"]We post regulary most powerful articles for help and support.[/cover-banner]'
                    ) .
                    Html::tag(
                        'div',
                        '[latest-news title="News By Resido,3"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/latest-news]'
                    )
                ,
            ],
            [
                'name'     => 'Trang ch??? 4',
                'content'  =>
                    Html::tag(
                        'div',
                        '[hero-banner title="Find Your Place<br>of Dream" bg="banners/banner-6.png" style="4"]Amet consectetur adipisicing <span class="badge badge-success">New</span>[/hero-banner]'
                    ) .
                    Html::tag('div', '[static-block alias="achievement"][/static-block]') .
                    Html::tag(
                        'div',
                        '[properties-slide title="Recent Property For Rent" limit="6" style="1"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/properties-slide]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-properties title="Explore Good Places" limit="6" type="2"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/featured-properties]'
                    ) .
                    Html::tag('div', '[static-block alias="how-it-works"][/static-block]') .
                    Html::tag(
                        'div',
                        '[testimonials title="Good Reviews By Customers" description="At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores"][/testimonials]'
                    ) .
                    Html::tag(
                        'div',
                        '[our-packages title="See Our Packages" description="At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores"][/our-packages]'
                    ) .
                    Html::tag('div', '[static-block alias="download-app"][/static-block]')
                ,
            ],
            [
                'name'     => 'Trang ch??? 5',
                'content'  =>
                    Html::tag(
                        'div',
                        '[hero-banner title="Find Your Perfect Place." bg="banners/home-2.png" style="5"]Amet consectetur adipisicing New[/hero-banner]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-properties title="Explore Good Places" limit="6" style="2" type="2"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/featured-properties]'
                    ) .
                    Html::tag(
                        'div',
                        '[properties-by-locations title="Find By Locations"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/properties-by-locations]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-properties title="Explore Good Places" limit="6" style="1" type="1"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/featured-properties]'
                    ) .
                    Html::tag(
                        'div',
                        '[testimonials title="Good Reviews By Customers" description="At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores"][/testimonials]'
                    ) .
                    Html::tag(
                        'div',
                        '[our-packages title="See Our Packages" description="At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores"][/our-packages]'
                    ) .
                    Html::tag(
                        'div',
                        '[static-block alias="download-app"][/static-block]'
                    )
                ,
            ],
            [
                'name'     => 'Trang ch??? 6',
                'content'  =>
                    Html::tag(
                        'div',
                        '[hero-banner title="Amet consectetur adipisicing" bg="banners/banner-6.png" style="6"]Find Your Place <br>Of Dream[/hero-banner]'
                    ) .
                    Html::tag('div', '[static-block alias="achievement"][/static-block]') .
                    Html::tag(
                        'div',
                        '[properties-slide title="Recent Property For Rent" limit="6" style="1"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/properties-slide]'
                    ) .
                    Html::tag(
                        'div',
                        '[properties-by-locations title="Find By Locations"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/properties-by-locations]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-properties title="Explore Good Places" limit="8" style="1" type="2"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/featured-properties]'
                    ) .
                    Html::tag('div', '[static-block alias="how-it-works"][/static-block]') .
                    Html::tag(
                        'div',
                        '[testimonials title="Good Reviews By Customers" description="At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores"][/testimonials]'
                    ) .
                    Html::tag(
                        'div',
                        '[our-packages title="See Our Packages" description="At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores"][/our-packages]'
                    ) .
                    Html::tag(
                        'div',
                        '[static-block alias="download-app"][/static-block]'
                    )
                ,
            ],
            [
                'name'     => 'Trang ch??? 7',
                'content'  =>
                    Html::tag(
                        'div',
                        '[hero-banner title="Find accessible homes to rent" bg="banners/banner-1.jpg"]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-properties title="Explore Good Places" limit="6" style="1" type="2"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/featured-properties]'
                    ) .
                    Html::tag(
                        'div',
                        '[properties-by-locations title="Find By Locations"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/properties-by-locations]'
                    ) .
                    Html::tag('div', '[static-block alias="how-it-works"][/static-block]') .
                    Html::tag(
                        'div',
                        '[cover-banner title="Search Perfect Place In Your City" bg="banners/banner-2.jpg" btntext="Explore More Property" btnlink="#"]We post regulary most powerful articles for help and support.[/cover-banner]'
                    ) .
                    Html::tag(
                        'div',
                        '[latest-news title="News By Resido,3"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/latest-news]'
                    )
                ,
            ],
            [
                'name'     => 'Trang ch??? 8',
                'content'  =>
                    Html::tag('div', '[properties-hero-slide limit="6"][/properties-hero-slide]') .
                    Html::tag('div', '[static-block alias="how-it-works"][/static-block]') .
                    Html::tag(
                        'div',
                        '[featured-properties title="Explore Good Places" limit="6" style="2" type="2"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/featured-properties]'
                    ) .
                    Html::tag(
                        'div',
                        '[properties-by-locations title="Find By Locations"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/properties-by-locations]'
                    ) .
                    Html::tag(
                        'div',
                        '[testimonials title="Good Reviews By Customers" description="At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores"][/testimonials]'
                    ) .
                    Html::tag(
                        'div',
                        '[our-packages title="See Our Packages" description="At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores"][/our-packages]'
                    )
                ,
            ],
            [
                'name'     => 'Trang ch??? 9',
                'content'  =>
                    Html::tag(
                        'div',
                        '[hero-banner title="Find accessible homes to rent" bg="banners/new-banner.jpg" style="2"]Find Your Perfect Place.[/hero-banner]'
                    ) .
                    Html::tag('div', '[static-block alias="achievement"][/static-block]') .
                    Html::tag(
                        'div',
                        '[properties-slide title="Recent Property For Rent" limit="6"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/properties-slide]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-properties title="Explore Good Places" limit="6" type="2"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/featured-properties]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-agents title="Explore Featured Agents"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/featured-agents]'
                    ) .
                    Html::tag(
                        'div',
                        '[testimonials title="Good Reviews By Customers" description="At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores"][/testimonials]'
                    ) .
                    Html::tag(
                        'div',
                        '[our-packages title="See Our Packages" description="At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores"][/our-packages]'
                    ) .
                    Html::tag('div', '[static-block alias="download-app"][/static-block]')
                ,
            ],
            [
                'name'     => 'Trang ch??? b???n ?????',
                'content'  =>
                    Html::tag('div', '[hero-banner-style-map][/hero-banner-style-map]') .
                    Html::tag('div', '[static-block alias="achievement"][/static-block]') .
                    Html::tag(
                        'div',
                        '[properties-slide title="Recent Property For Rent" limit="6"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/properties-slide]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-properties title="Explore Good Places" limit="6" type="2"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores[/featured-properties]'
                    ) .
                    Html::tag('div', '[static-block alias="how-it-works"][/static-block]') .
                    Html::tag(
                        'div',
                        '[testimonials title="Good Reviews By Customers" description="At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores"][/testimonials]'
                    ) .
                    Html::tag(
                        'div',
                        '[our-packages title="See Our Packages" description="At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores"][/our-packages]'
                    ) .
                    Html::tag('div', '[static-block alias="download-app"][/static-block]')
                ,
            ],
            [
                'name'     => 'Properties list',
                'content'  => '---',
            ],
            [
                'name'     => 'Tin t???c',
                'content'  => '---',
            ],
            [
                'name'        => 'V??? ch??ng t??i',
                'description' => 'Ch??ng t??i l?? ai v?? nhi???m v??? c???a ch??ng t??i',
                'content'     => Html::tag('div', '[static-block alias="our-story"][/static-block]') .
                    Html::tag('div', '[static-block alias="our-mission"][/static-block]')
                ,
            ],
            [
                'name'     => 'Li??n h???',
                'content'  => Html::tag('div', '[contact-form][/contact-form]') .
                    Html::tag('h3', 'T??m ???????ng ??i').
                    Html::tag('div', '[google-map]North Link Building, 10 Admiralty Street, 757695 Singapore[/google-map]')
                ,
            ],
            [
                'name'        => '??i???u kho???n v?? quy ?????nh',
                'description' => 'Quy???n t??c gi??? v?? c??c quy???n s??? h???u tr?? tu??? kh??c ?????i v???i m???i v??n b???n, h??nh ???nh, ??m thanh, ph???n m???m v?? c??c n???i dung kh??c tr??n trang web n??y thu???c quy???n s??? h???u c???a Resido c??ng c??c c??ng ty th??nh vi??n. Ng?????i truy c???p ???????c ph??p xem c??c n???i dung trong trang web, tr??ch d???n n???i dung b???ng c??ch in ???n, t???i v??? ????a c???ng v?? ph??n ph??t cho ng?????i kh??c ch??? v???i m???c ????ch phi th????ng m???i.',
                'content'     => '<p style="text-align: justify;"><span style="font-size:16px;"><span style="font-family:Arial,Helvetica,sans-serif;">Vi???c truy c???p v&agrave; s??? d???ng trang web c???a Resido ph??? thu???c v&agrave;o nh???ng ??i???u kho???n, ??i???u ki???n d?????i ??&acirc;y, v&agrave; lu???t ph&aacute;p li&ecirc;n quan c???a Vi???t Nam.</span></span></p>

                    <h4 style="text-align: justify;"><span style="font-size:18px;"><span style="font-family:Arial,Helvetica,sans-serif;"><strong>1. Quy???n t&aacute;c gi???&nbsp;</strong></span></span></h4>

                    <p style="text-align: justify;"><span style="font-size:16px;"><span style="font-family:Arial,Helvetica,sans-serif;">Quy???n t&aacute;c gi??? v&agrave; c&aacute;c quy???n s??? h???u tr&iacute; tu??? kh&aacute;c ?????i v???i m???i v??n b???n, h&igrave;nh ???nh, &acirc;m thanh, ph???n m???m v&agrave; c&aacute;c n???i dung kh&aacute;c tr&ecirc;n trang web n&agrave;y thu???c quy???n s??? h???u c???a Resido c&ugrave;ng c&aacute;c c&ocirc;ng ty th&agrave;nh vi&ecirc;n. Ng?????i truy c???p ???????c ph&eacute;p xem c&aacute;c n???i dung trong trang web, tr&iacute;ch d???n n???i dung b???ng c&aacute;ch in ???n, t???i v??? ????a c???ng v&agrave; ph&acirc;n ph&aacute;t cho ng?????i kh&aacute;c ch??? v???i m???c ??&iacute;ch phi th????ng m???i, cung c???p th&ocirc;ng tin ho???c m???c ??&iacute;ch c&aacute; nh&acirc;n. B???t k??? n???i dung n&agrave;o t??? trang web n&agrave;y ?????u kh&ocirc;ng ???????c s??? d???ng ????? b&aacute;n ho???c ph&acirc;n t&aacute;n ????? ki???m l???i v&agrave; c??ng kh&ocirc;ng ???????c ch???nh s???a ho???c ????a v&agrave;o b???t k??? ???n ph???m ho???c trang web n&agrave;o kh&aacute;c.</span></span></p>

                    <h4 style="text-align: justify;"><span style="font-size:18px;"><span style="font-family:Arial,Helvetica,sans-serif;"><strong>2. N???i dung</strong></span></span></h4>

                    <p style="text-align: justify;"><span style="font-size:16px;"><span style="font-family:Arial,Helvetica,sans-serif;">Th&ocirc;ng tin tr&ecirc;n trang web n&agrave;y ???????c bi&ecirc;n so???n v???i s??? tin t?????ng cao ????? nh??ng ch??? d&agrave;nh cho c&aacute;c m???c ??&iacute;ch nghi&ecirc;n c???u th&ocirc;ng tin t???ng qu&aacute;t. Tuy ch&uacute;ng t&ocirc;i n??? l???c duy tr&igrave; th&ocirc;ng tin c???p nh???t v&agrave; chu???n x&aacute;c, nh??ng ch&uacute;ng t&ocirc;i kh&ocirc;ng kh???ng ?????nh hay b???o ?????m theo b???t k??? c&aacute;ch th???c n&agrave;o v??? s??? ?????y ?????, ch&iacute;nh x&aacute;c, ??&aacute;ng tin c???y, th&iacute;ch h???p ho???c c&oacute; s???n li&ecirc;n quan ?????n trang web, ho???c th&ocirc;ng tin, s???n ph???m, d???ch v???, ho???c h&igrave;nh ???nh li&ecirc;n quan trong trang web v&igrave; b???t c??? m???c ??&iacute;ch g&igrave;. </span></span></p>

                    <p style="text-align: justify;"><span style="font-size:16px;"><span style="font-family:Arial,Helvetica,sans-serif;">Resido v&agrave; m???i nh&acirc;n vi&ecirc;n, nh&agrave; qu???n l&yacute;, v&agrave; c&aacute;c b&ecirc;n ?????i di???n ho&agrave;n to&agrave;n kh&ocirc;ng ch???u tr&aacute;ch nhi???m g&igrave; ?????i v???i b???t k??? t???n th???t, thi???t h???i ho???c chi ph&iacute; ph&aacute;t sinh do vi???c truy c???p v&agrave; s??? d???ng trang web n&agrave;y v&agrave; c&aacute;c trang web ???????c k???t n???i v???i n&oacute;, bao g???m nh??ng kh&ocirc;ng gi???i h???n, vi???c m???t ??i l???i nhu???n, c&aacute;c kho???n l??? tr???c ti???p ho???c gi&aacute;n ti???p. Ch&uacute;ng t&ocirc;i c??ng kh&ocirc;ng ch???u tr&aacute;ch nhi???m, ho???c li&ecirc;n ?????i tr&aacute;ch nhi???m n???u trang web t???m th???i kh&ocirc;ng th??? truy c???p do c&aacute;c v???n ????? k??? thu???t n???m ngo&agrave;i t???m ki???m so&aacute;t c???a ch&uacute;ng t&ocirc;i. M???i b&igrave;nh lu???n, g???i &yacute;, h&igrave;nh ???nh, &yacute; t?????ng v&agrave; nh???ng th&ocirc;ng tin hay t&agrave;i li???u kh&aacute;c m&agrave; ng?????i s??? d???ng chuy???n cho ch&uacute;ng t&ocirc;i th&ocirc;ng qua trang web n&agrave;y s??? tr??? th&agrave;nh t&agrave;i s???n ?????c quy???n c???a ch&uacute;ng t&ocirc;i, bao g???m c??? c&aacute;c quy???n c&oacute; th??? ph&aacute;t sinh trong t????ng lai g???n li???n v???i ch&uacute;ng t&ocirc;i.</span></span></p>

                    <p style="text-align:center"><img alt="" src="https://flex-home.botble.com/storage/general/copyright.jpg" style="width: 90%;" /></p>

                    <h4 style="text-align: justify;"><span style="font-size:18px;"><span style="font-family:Arial,Helvetica,sans-serif;"><strong>3. L??u &yacute; c&aacute;c trang web ???????c k???t n???i</strong></span></span></h4>

                    <p style="text-align: justify;"><span style="font-size:16px;"><span style="font-family:Arial,Helvetica,sans-serif;">T???i nhi???u ??i???m trong trang web, ng?????i s??? d???ng c&oacute; th??? nh???n ???????c c&aacute;c k???t n???i ?????n c&aacute;c trang web kh&aacute;c li&ecirc;n quan ?????n m???t kh&iacute;a c???nh c??? th???. ??i???u n&agrave;y kh&ocirc;ng c&oacute; ngh??a l&agrave; ch&uacute;ng t&ocirc;i c&oacute; li&ecirc;n quan ?????n nh???ng trang web hay c&ocirc;ng ty s??? h???u nh???ng trang web n&agrave;y. D&ugrave; ch&uacute;ng t&ocirc;i c&oacute; &yacute; ?????nh k???t n???i ng?????i s??? d???ng ?????n c&aacute;c trang web c???n quan t&acirc;m, nh??ng ch&uacute;ng t&ocirc;i v&agrave; c&aacute;c nh&acirc;n vi&ecirc;n, nh&agrave; qu???n l&yacute;, ho???c c&aacute;c b&ecirc;n ?????i di???n ho&agrave;n to&agrave;n kh&ocirc;ng ch???u tr&aacute;ch nhi???m ho???c li&ecirc;n ?????i ch???u tr&aacute;ch nhi???m g&igrave; ?????i v???i c&aacute;c trang web kh&aacute;c v&agrave; th&ocirc;ng tin ch???a ?????ng trong ??&oacute;.</span></span></p>
                    <p style="text-align: justify;"><span style="font-size:16px;"><span style="font-family:Arial,Helvetica,sans-serif;">At many points in the website, users can get links to other websites related to a specific aspect. This does not mean that we are related to the websites or companies that own these websites. Although we intend to connect users to sites of interest, we are not responsible or jointly responsible for our employees, managers, or representatives. with other websites and information contained therein.</span></span></p>
                    ',
            ],
            [
                'name'     => 'Cookie Policy',
                'content'  => Html::tag('h3', 'EU Cookie Consent') .
                    Html::tag(
                        'p',
                        '????? s??? d???ng trang web n??y, ch??ng t??i ??ang s??? d???ng Cookie v?? thu th???p m???t s??? D??? li???u. ????? tu??n th??? GDPR c???a Li??n minh Ch??u ??u, ch??ng t??i cho b???n l???a ch???n n???u b???n cho ph??p ch??ng t??i s??? d???ng m???t s??? Cookie nh???t ?????nh v?? thu th???p m???t s??? D??? li???u.'
                    ) .
                    Html::tag('h4', 'D??? li???u c???n thi???t') .
                    Html::tag(
                        'p',
                        'D??? li???u c???n thi???t l?? c???n thi???t ????? ch???y Trang web b???n ??ang truy c???p v??? m???t k??? thu???t. B???n kh??ng th??? h???y k??ch ho???t ch??ng.'
                    ) .
                    Html::tag(
                        'p',
                        '- Session Cookie: PHP s??? d???ng Cookie ????? x??c ?????nh phi??n c???a ng?????i d??ng. N???u kh??ng c?? Cookie n??y, trang web s??? kh??ng ho???t ?????ng.'
                    ) .
                    Html::tag(
                        'p',
                        '- XSRF-Token Cookie: Laravel t??? ?????ng t???o "token" CSRF cho m???i phi??n ng?????i d??ng ??ang ho???t ?????ng do ???ng d???ng qu???n l??. Token n??y ???????c s??? d???ng ????? x??c minh r???ng ng?????i d??ng ???? x??c th???c l?? ng?????i th???c s??? ????a ra y??u c???u ?????i v???i ???ng d???ng.'
                    ),
            ],
        ];

        Page::truncate();
        PageTranslation::truncate();
        Slug::where('reference_type', Page::class)->delete();
        MetaBoxModel::where('reference_type', Page::class)->delete();
        LanguageMeta::where('reference_type', Page::class)->delete();

        foreach ($pages as $index => $item) {
            $item['user_id'] = 1;
            $page = Page::create($item);

            Slug::create([
                'reference_type' => Page::class,
                'reference_id'   => $page->id,
                'key'            => Str::slug($page->name),
                'prefix'         => SlugHelper::getPrefix(Page::class),
            ]);
        }
        foreach ($translations as $index => $item) {
            $item['lang_code'] = 'vi';
            $item['pages_id'] = $index + 1;

            PageTranslation::insert($item);
        }
    }
}
