import queryString from "query-string";
import axiosClient from "../axiosClient";

const adminItemPersonTypeAPI = {
  getListOfItemPersonTypeAPI: async (
    search?: string,
    limit: number = 5,
    page: number = 0
  ): Promise<any[]> => {
    const url = "/api/v1/admin/item-person-type";
    const searchUrl = queryString.stringifyUrl(
      { url, query: { search, limit, page: page + 1 } },
      { arrayFormat: "index" }
    );
    const res = await axiosClient.get(searchUrl);
    return res.data;
  },
};

export default adminItemPersonTypeAPI;
