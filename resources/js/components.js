import {defineAsyncComponent} from "vue";

const globalComponents = {
    // Example: defineAsyncComponent(() => import('./components/Example')),
    SamplePage: defineAsyncComponent(() => import('./Pages/SamplePage')),
    DiskTable: defineAsyncComponent(() => import('./components/DiskTable')),
    DiskPage: defineAsyncComponent(() => import('./Pages/DiskPage')),
}

export const registerComponents = (app) => {
    for (let c in (globalComponents)) {
        app.component(c, globalComponents[c]);
    }
}
