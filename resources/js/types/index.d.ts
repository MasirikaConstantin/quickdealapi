import { InertiaLinkProps } from '@inertiajs/react';
import { LucideIcon } from 'lucide-react';

export interface Auth {
    user: User;
}
export interface Flash {
    success : string | null;
    error : string | null;
}
export interface PaginationCollection <T> {
    data:T[];
    links : {
        first :string;
        last : string;
        prev :string |null;
        next : string | null;
    };
    meta : {
        current_page : number;
        from : number;
        last_page :number;
        path :string;
        per_page: number;
        to : number;
        total :number;
        links :{
            url : string |null;
            label : string;
            active : boolean;
        }[];

    };
    
}
export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavGroup {
    title: string;
    items: NavItem[];
}

export interface NavItem {
    title: string;
    href: NonNullable<InertiaLinkProps['href']>;
    icon?: LucideIcon | null;
    isActive?: boolean;
}

export interface SharedData {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    sidebarOpen: boolean;
    [key: string]: unknown;
}

export interface User {
    id: number;
    name: string;
    fullname:string
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    two_factor_enabled?: boolean;
    created_at: string;
    updated_at: string;
    [key: string]: unknown; // This allows for additional properties...
}

export interface Produit{
    id:number,
    ref :string,
    titre :string,
    description :string,
    etat :string,
    prix :number,
    images :{
        id :number,
        url :string,
        thumb :string,
    }[],
    user_id :number,
    created_at :string,
    updated_at :string,
    [key: string]: unknown; // This allows for additional properties...
}
