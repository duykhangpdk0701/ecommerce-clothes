import IItemVariant from "@/interfaces/ItemVariant";
import queryString from "query-string";
import axiosClient from "../axiosClient";

const adminItemVariantAPI = {
  getListOfItemVariant: async (
    search?: string,
    limit: number = 5,
    page: number = 0
  ): Promise<IItemVariant[]> => {
    const url = "/api/v1/admin/item-variant";
    const searchUrl = queryString.stringifyUrl(
      { url, query: { search, limit, page: page + 1 } },
      { arrayFormat: "index" }
    );
    const res = await axiosClient.get(searchUrl);
    return res.data;
  },

  getListOfItemVarinatByItemId: async (id: number): Promise<IItemVariant[]> => {
    const url = `/api/v1/admin/item-variant/item/${id}`;
    const res = await axiosClient.get(url);
    return res.data;
  },
};

export default adminItemVariantAPI;
