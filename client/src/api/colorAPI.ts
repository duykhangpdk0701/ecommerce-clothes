import IColor from "@/interfaces/Color";
import axiosClient from "./axiosClient";

const colorAPI = {
  getListOfColor: async (): Promise<IColor[]> => {
    const url = "/api/v1/item-color";
    const res = await axiosClient.get(url);
    return res.data;
  },
};

export default colorAPI;
