import IUser from "interfaces/User";
import axiosClient from "../axiosClient";

const adminUserAPI = {
  getListOfUser: async (): Promise<IUser[]> => {
    const url = "/api/v1/admin/user";
    const res = await axiosClient.get(url);
    return res.data;
  },

  getUserById: async (id: string): Promise<IUser> => {
    const url = `/api/v1/admin/user/${id}`;
    const res = await axiosClient.get(url);
    return res.data;
  },
};

export default adminUserAPI;
