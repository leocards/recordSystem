import { ref } from "vue";
import { defineStore } from "pinia";
import { router, useForm } from "@inertiajs/vue3";

export const useLayoutStore = defineStore("Layout", () => {
    const windowSize = ref(window.innerWidth)
    const aside = useForm({
        header: "",
        selected: null
    });
    const csrfToken = ref(null);
    const showAside = ref(false);
    const isRepository = ref(false);
    const isRepo = ref(true)
    const preUpload = ref(false)
    const inputs = ref(null)
    const selectedItem = useForm({
        item: null
    })
    const notifications = ref([
        /* {
            state: null,
            message: null,
            link: null,
            timeClose: null
        } */
    ])
    const sampleData = ref([
        { id: 1, name: 'John', age: 30 },
        { id: 2, name: 'Alice', age: 25 },
        { id: 3, name: 'Bob', age: 35 },
        { id: 4, name: 'Jane', age: 28 },
        { id: 5, name: 'Janely', age: 28 },
        { id: 6, name: 'Jade', age: 28 },
        { id: 7, name: 'Jabbe', age: 28 },
        { id: 8, name: 'Janell', age: 28 },
    ])

    const openAside = () => (showAside.value = true);
    const closeAside = () => {showAside.value = false; aside.reset()}
    const toggleRepo = repo => isRepo.value = repo

    const preventDefaults = e => e.preventDefault()

    const getRouteTo = (route, preserve_scroll = true) => {
        router.get(route, {}, {
            preserveScroll: preserve_scroll
        })
    }

    const onUnloadPage = (e) => {
        e.preventDefault();
        e.returnValue = "";
    
        return "Changes you made might not be saved!";
    };

    let winH = ref(null)

    window.addEventListener("resize", () => {
        windowSize.value = window.innerWidth;
        winH.value = window.innerHeight
    });

    return {
        sampleData,
        
        winH,
        aside,
        isRepo,
        inputs,
        showAside,
        openAside,
        preUpload,
        csrfToken,
        getRouteTo,
        windowSize,
        toggleRepo,
        closeAside,
        selectedItem,
        onUnloadPage,
        isRepository,
        notifications,
        preventDefaults,
    };
});
