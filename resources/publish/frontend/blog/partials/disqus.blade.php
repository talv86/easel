@if( !empty( config('easel.disqus_name') ) )
    @if (isset($post->slug))

        <br/>

        <div id="disqus_thread"></div>

        <script type="text/javascript">
            var disqus_shortname = '{{ config('easel.disqus_name') }}';
            var disqus_identifier = 'blog-{{ $post->slug }}';
            (function () {
                var dsq = document.createElement('script');
                dsq.type = 'text/javascript';
                dsq.async = true;
                dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
            })();
        </script>

        <noscript>
            Please enable JavaScript to view the
            <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a>
        </noscript>

        <a href="http://disqus.com" class="dsq-brlink">
            comments powered by <span class="logo-disqus">Disqus</span>
        </a>

    @endif
@endif
