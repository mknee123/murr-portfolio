<?php

namespace GHInt\Theme\Post;

use WP_Post;

final class ShareLink
{
    /**
     * @var WP_Post
     */
    private WP_Post $post;
    /**
     * @var string
     */
    private string $url = '';
    /**
     * @var string
     */
    private string $body = '';
    /**
     * @var string
     */
    private string $target = '_blank';

    /**
     * @param WP_Post $post
     */
    public function __construct(WP_Post $post)
    {
        $this->post = $post;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Sets the URL to a formatted string using vsprintf
     * Default formatting arguments contain the following placeholders:
     *
     * %1$s - Urlencoded Post Permalink
     * %2$s - Urlencoded Post Title
     * %3$s - Raw Post Permalink
     * %4$s - Raw Post Title
     *
     * @param string $url
     * @param array $formatArgs
     * @return $this
     * @see https://www.php.net/manual/en/function.vsprintf.php
     */
    public function setUrl(string $url, array $formatArgs = []): self
    {
        if (!$formatArgs) {
            $rawAttributes = [get_permalink($this->post), get_the_title($this->post)];
            $formatArgs = array_merge(
                array_map('urlencode', $rawAttributes),
                $rawAttributes,
            );
        }

        $this->url = vsprintf($url, $formatArgs);
        return $this;
    }

    /**
     * @return string
     */
    public function getTarget(): string
    {
        return $this->target;
    }

    /**
     * @param string $target
     * @return $this
     */
    public function setTarget(string $target): self
    {
        $this->target = $target;
        return $this;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     * @return $this
     */
    public function setBody(string $body): self
    {
        $this->body = $body;
        return $this;
    }
}
