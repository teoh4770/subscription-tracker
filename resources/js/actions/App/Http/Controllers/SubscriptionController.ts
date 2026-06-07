import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\SubscriptionController::index
* @see app/Http/Controllers/SubscriptionController.php:21
* @route '/subscriptions'
*/
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/subscriptions',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\SubscriptionController::index
* @see app/Http/Controllers/SubscriptionController.php:21
* @route '/subscriptions'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\SubscriptionController::index
* @see app/Http/Controllers/SubscriptionController.php:21
* @route '/subscriptions'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\SubscriptionController::index
* @see app/Http/Controllers/SubscriptionController.php:21
* @route '/subscriptions'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\SubscriptionController::create
* @see app/Http/Controllers/SubscriptionController.php:30
* @route '/subscriptions/create'
*/
export const create = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

create.definition = {
    methods: ["get","head"],
    url: '/subscriptions/create',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\SubscriptionController::create
* @see app/Http/Controllers/SubscriptionController.php:30
* @route '/subscriptions/create'
*/
create.url = (options?: RouteQueryOptions) => {
    return create.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\SubscriptionController::create
* @see app/Http/Controllers/SubscriptionController.php:30
* @route '/subscriptions/create'
*/
create.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\SubscriptionController::create
* @see app/Http/Controllers/SubscriptionController.php:30
* @route '/subscriptions/create'
*/
create.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: create.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\SubscriptionController::store
* @see app/Http/Controllers/SubscriptionController.php:44
* @route '/subscriptions'
*/
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/subscriptions',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\SubscriptionController::store
* @see app/Http/Controllers/SubscriptionController.php:44
* @route '/subscriptions'
*/
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\SubscriptionController::store
* @see app/Http/Controllers/SubscriptionController.php:44
* @route '/subscriptions'
*/
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\SubscriptionController::show
* @see app/Http/Controllers/SubscriptionController.php:55
* @route '/subscriptions/{subscription}'
*/
export const show = (args: { subscription: number | { id: number } } | [subscription: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ["get","head"],
    url: '/subscriptions/{subscription}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\SubscriptionController::show
* @see app/Http/Controllers/SubscriptionController.php:55
* @route '/subscriptions/{subscription}'
*/
show.url = (args: { subscription: number | { id: number } } | [subscription: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
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

    return show.definition.url
            .replace('{subscription}', parsedArgs.subscription.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\SubscriptionController::show
* @see app/Http/Controllers/SubscriptionController.php:55
* @route '/subscriptions/{subscription}'
*/
show.get = (args: { subscription: number | { id: number } } | [subscription: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\SubscriptionController::show
* @see app/Http/Controllers/SubscriptionController.php:55
* @route '/subscriptions/{subscription}'
*/
show.head = (args: { subscription: number | { id: number } } | [subscription: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\SubscriptionController::edit
* @see app/Http/Controllers/SubscriptionController.php:62
* @route '/subscriptions/{subscription}/edit'
*/
export const edit = (args: { subscription: number | { id: number } } | [subscription: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})

edit.definition = {
    methods: ["get","head"],
    url: '/subscriptions/{subscription}/edit',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\SubscriptionController::edit
* @see app/Http/Controllers/SubscriptionController.php:62
* @route '/subscriptions/{subscription}/edit'
*/
edit.url = (args: { subscription: number | { id: number } } | [subscription: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
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

    return edit.definition.url
            .replace('{subscription}', parsedArgs.subscription.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\SubscriptionController::edit
* @see app/Http/Controllers/SubscriptionController.php:62
* @route '/subscriptions/{subscription}/edit'
*/
edit.get = (args: { subscription: number | { id: number } } | [subscription: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\SubscriptionController::edit
* @see app/Http/Controllers/SubscriptionController.php:62
* @route '/subscriptions/{subscription}/edit'
*/
edit.head = (args: { subscription: number | { id: number } } | [subscription: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: edit.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\SubscriptionController::update
* @see app/Http/Controllers/SubscriptionController.php:77
* @route '/subscriptions/{subscription}'
*/
export const update = (args: { subscription: number | { id: number } } | [subscription: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put","patch"],
    url: '/subscriptions/{subscription}',
} satisfies RouteDefinition<["put","patch"]>

/**
* @see \App\Http\Controllers\SubscriptionController::update
* @see app/Http/Controllers/SubscriptionController.php:77
* @route '/subscriptions/{subscription}'
*/
update.url = (args: { subscription: number | { id: number } } | [subscription: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
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

    return update.definition.url
            .replace('{subscription}', parsedArgs.subscription.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\SubscriptionController::update
* @see app/Http/Controllers/SubscriptionController.php:77
* @route '/subscriptions/{subscription}'
*/
update.put = (args: { subscription: number | { id: number } } | [subscription: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

/**
* @see \App\Http\Controllers\SubscriptionController::update
* @see app/Http/Controllers/SubscriptionController.php:77
* @route '/subscriptions/{subscription}'
*/
update.patch = (args: { subscription: number | { id: number } } | [subscription: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: update.url(args, options),
    method: 'patch',
})

/**
* @see \App\Http\Controllers\SubscriptionController::destroy
* @see app/Http/Controllers/SubscriptionController.php:84
* @route '/subscriptions/{subscription}'
*/
export const destroy = (args: { subscription: number | { id: number } } | [subscription: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/subscriptions/{subscription}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\SubscriptionController::destroy
* @see app/Http/Controllers/SubscriptionController.php:84
* @route '/subscriptions/{subscription}'
*/
destroy.url = (args: { subscription: number | { id: number } } | [subscription: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
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

    return destroy.definition.url
            .replace('{subscription}', parsedArgs.subscription.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\SubscriptionController::destroy
* @see app/Http/Controllers/SubscriptionController.php:84
* @route '/subscriptions/{subscription}'
*/
destroy.delete = (args: { subscription: number | { id: number } } | [subscription: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

const SubscriptionController = { index, create, store, show, edit, update, destroy }

export default SubscriptionController