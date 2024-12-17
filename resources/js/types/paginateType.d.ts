export interface PaginateType<T> {
    current_page: number;
    data: T[];
    first_page_url: string;
    from: number | null;
    last_page: number;
    links: {
        url: string;
        label: string;
        active: boolean;
    }[];
    last_page_url: string;
    next_page_url: string | null;
    path: string;
    per_page: number;
    prev_page_url: string | null;
    to: number | null;
    total: number;
}

export interface ResourcePaginateType<T> {
    data: T[];
    links?: {
        first: string | null;
        last: string | null;
        prev: string | null;
        next: string | null;
    };
    meta?: Meta;
}

export interface Meta {
    current_page: number;
    from: number;
    last_page: number;
    links: {
        url: null | string;
        label: string;
        active: boolean;
    }[];
    path: string;
    per_page: number;
    to: number;
    total: number;
}
