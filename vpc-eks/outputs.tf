output "cluster_name" {
  value = aws_eks_cluster.eks_cluster.name
}

output "cluster_endpoint" {
  value = aws_eks_cluster.eks_cluster.endpoint
}

output "cluster_role_arn" {
  value = aws_iam_role.eks_cluster_role.arn
}

output "node_role_arn" {
  value = aws_iam_role.eks_node_role.arn
}


# -----------------------------
# VPC and Networking Outputs
# -----------------------------

output "vpc_id" {
  description = "The ID of the VPC"
  value       = aws_vpc.main.id
}

output "public_subnet_ids" {
  description = "IDs of all public subnets"
  value       = [
    aws_subnet.public_subnet.id,
    aws_subnet.public_subnet_b.id
  ]
}

output "private_subnet_ids" {
  description = "IDs of all private subnets"
  value       = [
    aws_subnet.private_subnet.id,
    aws_subnet.private_subnet_b.id
  ]
}

output "internet_gateway_id" {
  description = "The ID of the Internet Gateway"
  value       = aws_internet_gateway.igw.id
}

output "nat_gateway_id" {
  description = "The ID of the NAT Gateway"
  value       = aws_nat_gateway.nat_gw.id
}

output "elastic_ip_id" {
  description = "The ID of the Elastic IP for the NAT Gateway"
  value       = aws_eip.nat_eip.id
}

output "public_route_table_id" {
  description = "The ID of the Public Route Table"
  value       = aws_route_table.public_rt.id
}

output "private_route_table_id" {
  description = "The ID of the Private Route Table"
  value       = aws_route_table.private_rt.id
}



