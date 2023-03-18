import { IAdminItemSize } from "@/interfaces/ItemSize";
import queryString from "query-string";
import axiosClient from "../axiosClient";

const adminItemSizeAPI = {
  getListOfItemSize: async (
    search?: string,
    limit: number = 5,
    page: number = 0
  ): Promise<IAdminItemSize[]> => {
    const url = "/api/v1/admin/item-size";
    const searchUrl = queryString.stringifyUrl(
      { url, query: { search, limit, page: page + 1 } },
      { arrayFormat: "index" }
    );
    const res = await axiosClient.get(searchUrl);
    return res.data;
  },

  getItemSizeById: async (id: string): Promise<IAdminItemSize> => {
    const url = `/api/v1/admin/item-size/${id}`;
    const res = await axiosClient.get(url);
    return res.data;
  },

  createItemSize: async (
    value: string,
    order: number,
    itemPersonTypeId: number,
    itemCategoryId: number,
    status: boolean
  ): Promise<IAdminItemSize[]> => {
    const url = "/api/v1/admin/item-size";
    const res = await axiosClient.post(url, {
      value,
      order,
      item_category_id: itemCategoryId,
      item_person_type_id: itemPersonTypeId,
    });
    return res.data;
  },

  updateItemSize: async (
    id: string,
    value: string,
    order: number,
    itemPersonTypeId: number,
    itemCategoryId: number,
    status: boolean
  ): Promise<IAdminItemSize> => {
    const url = `/api/v1/admin/item-size/${id}`;
    const res = await axiosClient.put(url, {
      value,
      order,
      item_category_id: itemCategoryId,
      item_person_type_id: itemPersonTypeId,
      status,
    });
    return res.data;
  },
};

export default adminItemSizeAPI;
