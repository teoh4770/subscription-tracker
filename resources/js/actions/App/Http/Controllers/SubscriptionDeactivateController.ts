import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\SubscriptionDeactivateController::__invoke
* @see app/Http/Controllers/SubscriptionDeactivateController.php:10
* @route '/subscriptions/{subscription}/deactivate'
*/
const SubscriptionDeactivateController = (args: { subscription: number | { id: number } } | [subscription: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: SubscriptionDeactivateController.url(args, options),
    method: 'patch',
})

SubscriptionDeactivateController.definition = {
    methods: ["patch"],
    url: '/subscriptions/{subscription}/deactivate',
} satisfies RouteDefinition<["patch"]>

/**
* @see \App\Http\Controllers\SubscriptionDeactivateController::__invoke
* @see app/Http/Controllers/SubscriptionDeactivateController.php:10
* @route '/subscriptions/{subscription}/deactivate'
*/
SubscriptionDeactivateController.url = (args: { subscription: number | { id: number } } | [subscription: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { subscription: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
        args = { subscription: args.id }
    }

    if (Array.isArray(args)) {
        args = {
            subscription: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        subscription: typeof args.subscription === 'object'
        ? args.subscription.id
        : args.subscription,
    }

    return SubscriptionDeactivateController.definition.url
            .replace('{subscription}', parsedArgs.subscription.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\SubscriptionDeactivateController::__invoke
* @see app/Http/Controllers/SubscriptionDeactivateController.php:10
* @route '/subscriptions/{subscription}/deactivate'
*/
SubscriptionDeactivateController.patch = (args: { subscription: number | { id: number } } | [subscription: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: SubscriptionDeactivateController.url(args, options),
    method: 'patch',
})

export default SubscriptionDeactivateController