import axios from "axios";

export default {
    namespaced: true,

    state: {
        results : {},
        pagination: {
            current_page: '',
            last_page: '',
            next_page_url: '',
            prev_page_url: '',
        }
    },

    actions: {
        fetchData(page_url) {
            axios.get(page_url)
                .then((res) => {
                    this.results = res.data;
                    this.makePagination(res.data.meta, res.data.links);
                })
                .catch((err) => console.log(err));
        },

        makePagination(meta, links) {
            this.pagination = {
                current_page: meta.current_page,
                last_page: meta.last_page,
                next_page_url: links.next,
                prev_page_url: links.prev,
            };
        },
    },
};
