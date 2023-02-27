<template>
    <div class="flex flex-col items-center">
        <div
            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-3 p-2 mx-auto"
        >
            <div
                v-for="pr in projects"
                class="relative items-center z-10 rounded-lg overflow-hidden flex flex-col justify-center cursor-pointer"
            >
                <section
                    class="flex justify-center items-end absolute bg-gradient-to-t from-gray-900 via-transparent to-transparent w-full h-full font-bold text-white"
                >
                    <h1 class="my-10">
                        {{ pr.title }}
                    </h1>
                </section>
                <img
                    :src="pr.image.url"
                    :alt="pr.slug"
                    class="w-96 h-96 object-cover"
                />
            </div>
        </div>
        <button v-if="!isLastPage" @click="fetchData">
            {{ loading ? "loading...." : "Load more" }}
        </button>
    </div>
</template>

<script setup>
import { onMounted, ref } from "vue";

const page = ref(1);
const isLastPage = ref(false);
const projects = ref([]);
const loading = ref(false);
const fetchData = async () => {
    loading.value = true;
    try {
        const res = await fetch(
            `/api/collections/projects/entries?sort=title&limit=2&page=${page.value++}`
        ); // Get the data from the API
        const { data, meta } = await res.json();
        isLastPage.value = meta.current_page == meta.last_page;
        projects.value.push(...data);
    } catch (e) {
        console.log(e);
    } finally {
        loading.value = false;
    }
};

onMounted(() => {
    fetchData();
});
</script>
