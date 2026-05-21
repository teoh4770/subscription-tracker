export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at?: string;
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    auth: {
        user: User;
    };
};

export interface Subscription {
    id: number;
    name: string;
    price: number;
    billing_period: string;
    start_date: string;
    next_billing_date: string;
    days_until_next_billing: number;
    billing_cycle_progress: number;
    active: boolean;
    is_trial: boolean;
    notes: string | null;
    image_url: string | null;
    created_at: string;
    updated_at: string;
    category: Category | null;
    company: Company | null;
    payment_method: PaymentMethod | null;
}
