import { IAdminCategory } from "@/interfaces/Category";
import queryString from "query-string";
import axiosClient from "../axiosClient";

const adminItemCategoryAPI = {
  getListOfItemCategory: async (
    search?: string,
    limit: number = 5,
    page: number = 0
  ): Promise<IAdminCategory[]> => {
    const url = "/api/v1/admin/item-category";
    const searchUrl = queryString.stringifyUrl(
      { url, query: { search, limit, page: page + 1 } },
      { arrayFormat: "index" }
    );
    const res = await axiosClient.get(searchUrl);
    return res.data;
  },

  getItemCategoryBySlug: async (slug: string): Promise<IAdminCategory> => {
    const url = `/api/v1/admin/item-category/${slug}`;
    const res = await axiosClient.get(url);
    return res.data;
  },
};

export default adminItemCategoryAPI;
