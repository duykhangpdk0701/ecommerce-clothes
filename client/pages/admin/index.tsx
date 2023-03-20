import AdminLayout from "@/layout/AdminLayout";
import React, { ReactElement } from "react";
import DashBoardTemplate from "@/components/templates/admin/dashboard";

const Admin = () => {
  return <DashBoardTemplate />;
};

Admin.getLayout = function (page: ReactElement) {
  return <AdminLayout>{page}</AdminLayout>;
};

export default Admin;
