	<?php get_header(); ?>
	<style type="text/css">
#head #logotype .blog {
    display: none;
}

    #head #logotype .voice {
            display: block;
    }
.voice-wrap__lead{
font-weight: bold;
margin:2rem 0 1rem 0;
display: block;
}

.voice-wrap__comment-link{
	margin-top:1.5rem;
	padding-top: 1.5rem;
	border-top:1px solid #ccc;
}
.voice-wrap__comment-link a{
color: #ff1493;
}
.single-voice #support h3{
	font-size: 1.2rem;
	margin-top: 1rem;
		margin-bottom:1rem;
	padding-bottom: 1rem;
	border-bottom:1px solid #ccc;
}

.single-voice #support p{
line-height: 1.5rem;
}
.single-voice #comments h3{
	font-size: 1.2rem;
	background: #ff1493;
font-weight: normal;
padding: 0.25rem 1rem;
border-radius: 4px;
color: #fff;
font-weight: bold;
text-align: center;
}

	</style>

	<div id="content" class="clearfix single-page">
	    <div id="contentInner">
	        <main <?php st_text_copyck(); ?>>
	            <article>
	                <div id="post-<?php the_ID(); ?>" <?php st_post_class(); ?>>
	                    <!--breadcrumb-->
	                    <div id="breadcrumb">
	                        <div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
	                            <a href="<?php echo home_url(); ?>" itemprop="url"> <span itemprop="title">ホーム</span>
	                            </a> &gt;
	                        </div>
	                        <?php $postcat = get_the_category(); ?>
	                        <?php $catid = $postcat[0]->cat_ID; ?>
	                        <?php $allcats = array( $catid ); ?>
	                        <?php
						while ( !$catid == 0 ) {
							$mycat = get_category( $catid );
							$catid = $mycat->parent;
							array_push( $allcats, $catid );
						}
						array_pop( $allcats );
						$allcats = array_reverse( $allcats );
						?>
	                        <?php foreach ( $allcats as $catid ): ?>
	                        <div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
	                            <a href="<?php echo get_category_link( $catid ); ?>" itemprop="url">
	                                <span itemprop="title"><?php echo esc_html( get_cat_name( $catid ) ); ?></span> </a>
	                            &gt;
	                        </div>
	                        <?php endforeach; ?>
	                    </div>
	                    <!--/breadcrumb-->
	                    <!--ループ開始 -->
	                    <?php if (have_posts()) : while (have_posts()) :
					the_post(); ?>
	                    <h1 class="entry-title"><?php the_title(); //タイトル ?></h1>
	                    <p>
	                        <span class="kdate">
	                            <!--i class="fa fa-calendar"></i-->
	                            <time class="entry-date date updated" datetime="<?php the_time(DATE_W3C); ?>">
	                                <?php the_time( 'Y/m/d' ); ?>
	                            </time>
	                            <?php if ( $mtime = st_get_mtime( 'Y/m/d' ) ) {
									echo ' <i class="fa fa-repeat"></i>&nbsp; ', $mtime;
								} ?>
	                        </span>
	                    </p>

	                    <?php // You can check archive URL
						//echo get_post_type_archive_link( 'voice' ); ?>
	                    <!--VAR-->
	                    <?php $audio_file = get_field('audio_file'); ?>
	                    <?php $notes = get_field('notes'); ?>
	                    <!--VAR END-->
	                    <section class="voice-wrap">
	                        <?php if(empty($audio_file)):?>
	                        <!--none-->
	                        <?php else:?>
	                        <!--Conditional branch VAR-->
	                        <section class="voice-wrap__main">
	                            <audio preload="metadata" controls>
								<source src="<?php echo $audio_file; ?>">
	                                <p>どうやらご使用のブラウザが古くて頑固な方で、音声の再生なんぞするものかとおっしゃっています。どなたか最近の方をお呼びしてはいかがでしょう。</p>
	                            </audio>
	                        </section>
	                        <?php endif;?>
	                        <!--END Conditional branch VAR-->
	                        <?php if(empty($notes)):?>
	                        <!--none-->
	                        <?php else:?>
	                        <small class="voice-wrap__lead">なにを話したか、かいつまんで言いますと……</small>
	                        <p><?php echo $notes; ?></p>
	                        <?php endif;?>

	                <!--ページナビ-->
	                <div class="p-navi clearfix">
	                    <dl>
	                        <?php
								$prev_post = get_previous_post();
								if ( !empty( $prev_post ) ): ?>
	                        <dt><i class="fa fa-chevron-circle-left" aria-hidden="true"></i>前の記事</dt>
	                        <dd>
	                            <a
	                                href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>"><?php echo $prev_post->post_title; ?></a>
	                        </dd>
	                        <?php endif; ?>
	                        <?php
								$next_post = get_next_post();
								if ( !empty( $next_post ) ): ?>
	                        <dt>次の記事<i class="fa fa-chevron-circle-right" aria-hidden="true"></i></dt>
	                        <dd>
	                            <a
	                                href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>"><?php echo $next_post->post_title; ?></a>
	                        </dd>
	                        <?php endif; ?>
	                    </dl>
	                </div>

	                        <!--END Conditional branch VAR-->
							<p class="voice-wrap__comment-link">
							<strong>皆さまからのお便りをお待ちしております。</strong><br><a href="#comments"><u>コメント欄</u> <i class="far fa-comment-dots"></i></a>より何でも遠慮なくお書き込みください。いただきましたお便りは、すべて次回の音声ブログで紹介させていただきます。</a>
							</p>							
							<aside class="voice-wrap__comment-link" style="font-size: 0.75rem!important;">
								<strong style="display:block;margin-bottom:0.5rem;color: #ff1493;">*アートプロジェクトとしての音声ブログ
								</strong>
								この音声ブログは新宅睦仁の人生その日々の限られた時間を用いたアートプロジェクトです。<strong>死ぬ前日あるいは死ぬ当日まで、毎日1回録音・公開</strong>いたします(各平均5分程度)。<br>
									録音件数が多くなればなるほど＝積み重ねた時間が増えれば増えるほど、最期の日の録音、その声は、言葉は、たとえどんなにくだらない内容であったとしても、有無を言わさず他人になにかしら得も言われぬ感慨――災難に巻き込まれた人々の遺した最期の声に感ずるような――を与えることになるでしょう。
								</aside>
	                    </section>

	                </div>
	                <?php the_content(); //本文 ?>
	                <?php include ($_SERVER['DOCUMENT_ROOT'].'/inc/common/blog-profile.php'); //common pfofile unit for blog ?>
	                <?php get_template_part('common_inc/support'); //支援のお願い ?>
	                <?php get_template_part('common_inc/blogs-link-list'); //各ブログへのリンク ?>
	                <?php get_template_part( 'sns' ); //ソーシャルボタン読み込み ?>
	                <?php if ( function_exists( 'dynamic_sidebar' ) && dynamic_sidebar( 5 ) ) : else : ?>
	                <?php endif; ?>
	                <?php get_template_part( 'popular-thumbnail' ); //任意のエントリ ?>
	                <?php get_template_part( 'st-rank' ); ?>
	                <?php wp_link_pages(); ?>
	                <!--p class="tagst"><i class="fa fa-tags"></i>&nbsp;-
						<?php the_category( ', ' ) ?>
						<?php the_tags( '', ', ' ); ?>
					</p-->
	                <!-- /#wrapper -->
	                <section style="margin-top:0;">
	                    <aside>
	                        <?php
								//コメント
								if ( ( $GLOBALS["stdata6"] ) === '' ) { ?>
	                        <?php if ( comments_open() || get_comments_number() ) {
										comments_template();
									} ?>
	                        <?php } ?>
	                    </aside>
	                </section>
	                <!--ページナビ-->
	                <div class="p-navi clearfix">
	                    <dl>
	                        <?php
								$prev_post = get_previous_post();
								if ( !empty( $prev_post ) ): ?>
	                        <dt><i class="fa fa-chevron-circle-left" aria-hidden="true"></i>前の記事</dt>
	                        <dd>
	                            <a
	                                href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>"><?php echo $prev_post->post_title; ?></a>
	                        </dd>
	                        <?php endif; ?>
	                        <?php
								$next_post = get_next_post();
								if ( !empty( $next_post ) ): ?>
	                        <dt>次の記事<i class="fa fa-chevron-circle-right" aria-hidden="true"></i></dt>
	                        <dd>
	                            <a
	                                href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>"><?php echo $next_post->post_title; ?></a>
	                        </dd>
	                        <?php endif; ?>
	                    </dl>
	                </div>
	                <?php endwhile; else: ?>
	                <p>記事がありません</p>
	                <?php endif; ?>
	                <!--ループ終了-->
	                </aside>
	                <!--/post-->
	            </article>
	        </main>
	    </div>
	    <!-- /#contentInner -->
	    <!--?php get_sidebar(); ?-->
	</div>
	<!--/#content -->
	<?php get_footer(); ?>