import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\SubscriptionActivateController::__invoke
* @see app/Http/Controllers/SubscriptionActivateController.php:10
* @route '/subscriptions/{subscription}/activate'
*/
const SubscriptionActivateController = (args: { subscription: number | { id: number } } | [subscription: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: SubscriptionActivateController.url(args, options),
    method: 'patch',
})

SubscriptionActivateController.definition = {
    methods: ["patch"],
    url: '/subscriptions/{subscription}/activate',
} satisfies RouteDefinition<["patch"]>

/**
* @see \App\Http\Controllers\SubscriptionActivateController::__invoke
* @see app/Http/Controllers/SubscriptionActivateController.php:10
* @route '/subscriptions/{subscription}/activate'
*/
SubscriptionActivateController.url = (args: { subscription: number | { id: number } } | [subscription: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
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

    return SubscriptionActivateController.definition.url
            .replace('{subscription}', parsedArgs.subscription.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\SubscriptionActivateController::__invoke
* @see app/Http/Controllers/SubscriptionActivateController.php:10
* @route '/subscriptions/{subscription}/activate'
*/
SubscriptionActivateController.patch = (args: { subscription: number | { id: number } } | [subscription: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: SubscriptionActivateController.url(args, options),
    method: 'patch',
})

export default SubscriptionActivateController