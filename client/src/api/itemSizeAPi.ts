import ISize from "@/interfaces/Size";
import axiosClient from "./axiosClient";

const itemSizeAPI = {
  getList: async (): Promise<ISize[]> => {
    const url = "/api/v1/item-size";
    const res = await axiosClient.get(url);
    return res.data;
  },
};

export default itemSizeAPI;
