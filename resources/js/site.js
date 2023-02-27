// This is all you.

import { createApp } from "vue/dist/vue.esm-bundler";
import ExampleFieldtype from "./components/fieldtypes/ExampleFieldtype.vue";
import BlogsContainer from "./components/BlogsContainer.vue";
const app = createApp();

app.component("ProjectsField", ExampleFieldtype);
app.component("BlogsContainer", BlogsContainer);

app.mount("#app");
