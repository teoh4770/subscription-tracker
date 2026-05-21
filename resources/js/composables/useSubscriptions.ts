import { computed, ref } from 'vue';
import type { Subscription } from '@/types';

export enum SubscriptionFilterEnum {
    All = 'All',
    Active = 'Active',
    Cancelled = 'Cancelled',
}

export function useSubscriptions(getSubscriptions: () => Subscription[]) {
    const filter = ref<SubscriptionFilterEnum>(SubscriptionFilterEnum.All);

    const filteredSubscriptions = computed(() => {
        const subscriptions = getSubscriptions();

        if (filter.value === SubscriptionFilterEnum.Active) {
            return subscriptions.filter((subscription) => subscription.active);
        } else if (filter.value === SubscriptionFilterEnum.Cancelled) {
            return subscriptions.filter((subscription) => !subscription.active);
        }

        return subscriptions;
    });

    return { filter, filteredSubscriptions };
}
