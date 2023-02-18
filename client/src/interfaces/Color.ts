interface IColor {
  id: string;
  name: string;
}

export interface IAdminColor extends IColor {
  status: boolean;
}

export default IColor;
