export class Page {
    ID: number;
    post_author: string;
    post_date: string;
    post_date_gmt: string;
    post_content: string;
    post_title: string;
    post_excerpt: string;
    post_status: string;
    comment_status: string;
    ping_status: string;
    post_password: string;
    post_name: string;
    to_ping: string;
    pinged: string;
    post_modified: string;
    post_modified_gmt: string;
    post_content_filtered: string;
    post_parent: number;
    guid: string;
    menu_order: number;
    post_type: string;
    post_mime_type: string;
    comment_count: string;
    filter: string;
    blog_title: string;
    blog_description: string;
    meta_data: any;
    post_parent_title: string;
    page_template: string;
    post_thumbnail: string;
    children: Page[];
    breadcrumbs: Breadcrumb[];
}
export class Breadcrumb {
    id: number;
    slug: string;
    title: string;
}