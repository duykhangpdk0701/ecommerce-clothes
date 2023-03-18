import { IAdminColor } from "@/interfaces/Color";
import queryString from "query-string";
import axiosClient from "../axiosClient";

const adminItemColorAPI = {
  getListOfItemColor: async (
    search?: string,
    limit: number = 5,
    page: number = 0
  ): Promise<IAdminColor[]> => {
    const url = "/api/v1/admin/item-color";
    const searchUrl = queryString.stringifyUrl(
      { url, query: { search, limit, page: page + 1 } },
      { arrayFormat: "index" }
    );
    const res = await axiosClient.get(searchUrl);
    return res.data;
  },

  getItemColorById: async (id: string): Promise<IAdminColor> => {
    const url = `/api/v1/admin/item-color/${id}`;
    const res = await axiosClient.get(url);
    return res.data;
  },

  createItemColor: async (
    name: string,
    value: string,
    order: number
  ): Promise<IAdminColor[]> => {
    const url = "/api/v1/admin/item-color";
    const res = await axiosClient.post(url, { name, value, order });
    return res.data;
  },

  updateItemColor: async (
    id: string,
    name: string,
    value: string,
    order: number,
    status: boolean
  ): Promise<IAdminColor> => {
    const url = `/api/v1/admin/item-color/${id}`;
    const res = await axiosClient.put(url, { name, value, order, status });
    return res.data;
  },
};

export default adminItemColorAPI;
