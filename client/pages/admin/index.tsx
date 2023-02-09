import AdminLayout from "@/layout/AdminLayout";
import React, { ReactElement } from "react";

const Admin = () => {
  return <div>Admin</div>;
};

Admin.getLayout = function (page: ReactElement) {
  return <AdminLayout>{page}</AdminLayout>;
};

export default Admin;
