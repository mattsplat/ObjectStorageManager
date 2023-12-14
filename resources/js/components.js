import {defineAsyncComponent} from "vue";

const globalComponents = {
    // Example: defineAsyncComponent(() => import('./components/Example')),
    SamplePage: defineAsyncComponent(() => import('./Pages/SamplePage')),
}

export const registerComponents = (app) => {
    for (let c in (globalComponents)) {
        app.component(c, globalComponents[c]);
    }
}
