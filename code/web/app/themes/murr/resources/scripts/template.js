const blogPostClass = "m-card";
export class BlogPost {
    constructor(data) {
        this._data = data;
        this._prefix = blogPostClass;
    }

    render() {
        return `<article class="${this._prefix} ${this._prefix}--post ${this._prefix}--bg-light-blue">               
            ${this._renderImage()}
            ${this._renderCat()}
            ${this._renderTitle()}
            ${this._renderCTA()}
        </article>`;
    }

    _renderImage() {
        const title = this._data.title.rendered;
        const img = this._data.image_with_fallback;

        return `<a href="${this._data.link}" title="${title}" class="${this._prefix}__image"><img src="${img}" alt="${title}"></a>`;
    }

    _renderCat() {
        const cat = this._data._embedded["wp:term"][0];

        if (cat) {
            let categories = [];
            $.each(cat, (i, value) => {
                console.log(value);
                categories.push(value.name);
            });
            categories = categories.toString();
            categories = categories.replace(/,/g, ", ");

            return `<p class="${this._prefix}__categories text--font-size--mini text--uppercase">${categories}</p>`;
        }
        return "";
    }

    _renderTitle() {
        const title = this._data.title.rendered;
        return `<h2 class="${this._prefix}__heading">${title}</h2>`;
    }

    _renderExcerpt() {
        const excerpt = this._data.excerpt.rendered;
        return `<div class="${this._prefix}__excerpt">${excerpt}</div>`;
    }

    _renderCTA() {
        return `<div class="${this._prefix}__link"><a href="${this._data.link}" class="a-button a-button--micro">Read More</a></div>`;
    }
}
