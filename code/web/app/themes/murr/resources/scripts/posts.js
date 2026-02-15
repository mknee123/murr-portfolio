/*
	Name:		    	posts.js
	Description:  Post script for the theme.
	Version:      1.0.1
	Author:       MK
*/
import jQuery from "jquery";
import { BlogPost } from "./template.js";
(($, buffer) => {
    $(() => {
        let timer,
            loading = false;
        const $block = $(".o-card-grid"),
            $grid = $block.find(".o-card-grid__grid"),
            $currentPage = $(".o-card-grid input[name=page]"),
            $exclude = $(".o-card-grid input[name=exclude]"),
            $catFilter = $("#news-filter-by-category"),
            $button = $block.find(".o-card-grid__button"),
            $loadInsights = $("#load-news");

        // Check for masthead-post and grab data ID
        // Add that ID to the exclude filter
        // Comment out if removing masthead-post from post-grid is undesired.
        const checkPostMasthead = () => {
            const $post = $(".o-masthead-post").data("id");
            $exclude.val($post);
        };
        checkPostMasthead();

        $block
            .on("submit", ".m-filter", (e) => {
                e.preventDefault();
                $grid.empty();
                $block.trigger("gh:update", [1]);
            })
            .on("change", ".a-input-field select", (e) => {
                $grid.empty();
                $block.trigger("gh:update", [1]);
            })
            .on("input", ".a-input-field input[type=search]", () => {
                clearTimeout(timer);
                timer = setTimeout(() => {
                    $grid.empty();
                    $block.trigger("gh:update", [1]);
                }, buffer);
            })
            .on("gh:update", (e, page) => {
                if (loading) {
                    return;
                }
                loading = true;
                clearTimeout(timer);
                const $form = $(".m-filter");
                const $pager = $form.find(".a-input-field input[name=page]");
                $pager.val(page);

                const data = $form
                    .serializeArray()
                    .filter(({ value }) => !!value)
                    .map(({ name, value }) => (value === "true" ? name : `${name}=${value}`))
                    .join("&");

                $.ajax({
                    url: $form[0].action,
                    method: $form[0].method,
                    data,
                    success(data, status, xhr) {
                        loading = false;
                        $grid.trigger("gh:render", [data]);
                        $pager.trigger("gh:page", [page, parseInt(xhr.getResponseHeader("X-Wp-Totalpages"), 10)]);
                    },
                    error(xhr, status, error) {
                        loading = false;
                        console.log(xhr, status, error);
                    },
                });
            })
            .on("gh:page", (e, page, total) => {
                if (page < total) {
                    $currentPage.val(parseInt(page) + 1);
                    $loadInsights.removeAttr("disabled").text("Show More ").parent($button).fadeIn();
                } else {
                    $loadInsights.attr("disabled", "disabled").text("No More News").parent($button).delay(2000).fadeOut();
                }
            });

        $grid.on("gh:render", (e, data) => {
            if (data.length) {
                $.each(data, (i, item) => {
                    const blogPost = new BlogPost(item);
                    $grid.append(blogPost.render());
                });
                revealBlogPosts();
            } else {
                $grid.html("<h2>Sorry, no results found.</h2>");
            }
        });

        const loadMore = (loadButton) => {
            loadButton.on("click tap", (e) => {
                e.preventDefault();
                const $loadButton = $(e.currentTarget);
                let page = $currentPage.val();
                if (!$loadButton.is(".a-button--disabled")) {
                    $block.trigger("gh:update", [page]);
                }
            });
        };

        const revealBlogPosts = () => {
            $(".m-card--post", $grid).each(function (index) {
                const row = $(this);
                setTimeout(function () {
                    row.addClass("m-card--show");
                }, 50 * index);
            });
        };

        loadMore($loadInsights);

        //get text & values of all categories in dropdown filter
        const categoryOptions = [];
        $("#news-filter-by-category option").each(function (i) {
            const text = $(this).text();
            const value = $(this).val();
            //skip first option and grab text and value of all other options
            if (i > 0) {
                categoryOptions.push([text.toLowerCase(), parseInt(value)]);
            }
        });

        const getUrlParameter = (sParam, sVal) => {
            const urlParams = new URLSearchParams(window.location.search);
            //if url matches the params filters
            if (urlParams.toString() === sParam) {
                $catFilter.find(`option[value=${sVal}]`).prop("selected", "selected");
                return;
            }
        };

        const updateUrl = (category, url) => {
            if (typeof history.pushState != "undefined") {
                const newUrl = "?" + category + "=" + url;
                const obj = { Page: category, Url: newUrl };
                history.pushState(obj, "", obj.Url);
                return;
            }
        };

        const clearUrl = () => {
            const refresh = window.location.protocol + "//" + window.location.host + window.location.pathname + "";
            window.history.pushState({ path: refresh }, "", refresh);
        };

        //If url has a parameter labeled 'category' and the value matches any of the options in the category dropdown filter then run the UrlParameter filter
        $.each(categoryOptions, (i, value) => {
            getUrlParameter(`category=${value[0]}`, value[1]);
        });

        $grid.empty();
        $block.trigger("gh:update", [1]);
    });
})(jQuery, 750);
