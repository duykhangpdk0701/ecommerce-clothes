import { IAdminBrand } from "@/interfaces/Brand";
import queryString from "query-string";
import axiosClient from "../axiosClient";

const adminBrandAPI = {
  getListOfBrand: async (
    search?: string,
    limit: number = 5,
    page: number = 0
  ): Promise<IAdminBrand[]> => {
    const url = "/api/v1/admin/brand";
    const searchUrl = queryString.stringifyUrl(
      { url, query: { search, limit, page: page + 1 } },
      { arrayFormat: "index" }
    );
    const res = await axiosClient.get(searchUrl);
    return res.data;
  },

  getBrandById: async (id: string): Promise<IAdminBrand> => {
    const url = `/api/v1/admin/brand/${id}`;
    const res = await axiosClient.get(url);
    return res.data;
  },

  createBrand: async (
    name: string,
    slug: string,
    order: number,
    status: boolean
  ): Promise<IAdminBrand> => {
    const url = "/api/v1/admin/brand";
    const res = await axiosClient.post(url, { name, slug, order, status });
    return res.data;
  },

  updateBrand: async (
    id: string,
    name: string,
    slug: string,
    order: number,
    status: boolean
  ): Promise<IAdminBrand> => {
    const url = `/api/v1/admin/brand/${id}`;
    const res = await axiosClient.put(url, { name, slug, order, status });
    return res.data;
  },
};

export default adminBrandAPI;
