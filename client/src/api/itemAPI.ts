import IProduct from "@/interfaces/Product";
import axiosClient from "./axiosClient";
import queryString from "query-string";

const itemAPI = {
  getListOfItem: async (search: {
    order_by?: string;
    item_person_type_id?: string;
    brand_id?: string;
    item_category_id?: string;
    item_color_ids?: string[];
    item_size_ids?: string[];
  }): Promise<IProduct[]> => {
    const url = "/api/v1/item";
    const searchUrl = queryString.stringifyUrl(
      { url, query: search },
      { arrayFormat: "index" }
    );

    const res = await axiosClient.get(searchUrl);
    return res.data;
  },

  getItemBySlug: async (slug: string): Promise<IProduct> => {
    const url = `/api/v1/item/${slug}`;
    const res = await axiosClient.get(url);
    return res.data;
  },
};

export default itemAPI;
