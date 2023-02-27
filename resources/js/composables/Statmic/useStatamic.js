import { ref } from "vue";
import config from "./statamic-config";

const makeHttpRequest = (url, config = {}) => {
    return new Promise((resolve, reject) => {
        fetch(url)
            .then((res) => res.json())
            .then((jsonResponse) => resolve(jsonResponse))
            .catch((err) => {
                reject(err);
            });
    });
};

const useStatamicApi = () => {
    const fetchCollection = (type, query = "") => {
        return new Promise((resolve, reject) => {
            if (!type) {
                reject(
                    new Error(
                        "Please define type for which you are using this method."
                    )
                );
            }

            const url = `/api/collections/${type}/entries`;

            makeHttpRequest(`${url}${query}`)
                .then((response) => resolve(response))
                .catch((err) => reject(err));
        });
    };

    return {
        fetchCollection,
    };
};

export { useStatamicApi };
