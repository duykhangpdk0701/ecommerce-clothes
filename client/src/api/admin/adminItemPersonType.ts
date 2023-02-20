import axiosClient from "../axiosClient";

const adminItemPersonTypeAPI = {
  getListOfItemPersonTypeAPI: async (): Promise<any[]> => {
    const url = "/api/v1/admin/item-person-type";
    const res = await axiosClient.get(url);
    return res.data;
  },
};

export default adminItemPersonTypeAPI;
