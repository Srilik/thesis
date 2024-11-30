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
