import ICategory from "interfaces/Category";
import axiosClient from "./axiosClient";

const categoryAPI = {
  getListOfCategory: async (): Promise<ICategory[]> => {
    const url = "/api/v1/item-category?with_children=true";
    const res = await axiosClient.get(url);
    return res.data;
  },
};

export default categoryAPI;
